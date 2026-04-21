<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

class PHPMailerService
{
    /**
     * Send an email via SMTP using PHPMailer.
     *
     * $message format:
     * [
     *   'from' => ['email@domain.com' => 'Name'] OR 'email@domain.com' (optional; falls back to config)
     *   'to'   => ['email@domain.com' => 'Name'] OR ['a@b.com','c@d.com'] OR 'email@domain.com' (required)
     *   'subject' => '...',
     *   'html'    => '<p>...</p>', (required)
     *
     *   // optional:
     *   'text'     => 'Plain text...',
     *   'cc'       => ...
     *   'bcc'      => ...
     *   'reply_to' => ...
     *   'headers'  => ['X-Foo' => 'bar']
     *   'attachments' => [
     *       ['path' => storage_path('app/file.pdf'), 'name' => 'File.pdf'],
     *       ['string' => $rawBytes, 'name' => 'file.txt', 'mime' => 'text/plain'],
     *   ],
     * ]
     */
    public function send(array $message): array
    {
        $mail = $this->makeMailer();

        try {
            // FROM (message first, fallback to config)
            if (!empty($message['from'])) {
                $this->setFrom($mail, $message['from']);
            } else {
                $this->setFrom($mail, [
                    config('phpmailer.from.address') => config('phpmailer.from.name'),
                ]);
            }

            // REPLY-TO (message first, fallback to config)
            if (!empty($message['reply_to'])) {
                $this->addRecipients($mail, 'addReplyTo', $message['reply_to']);
            } else {
                $replyAddr = config('phpmailer.reply_to.address');
                if ($replyAddr) {
                    $mail->addReplyTo($replyAddr, config('phpmailer.reply_to.name') ?: $replyAddr);
                }
            }

            // TO / CC / BCC
            if (empty($message['to'])) {
                throw new \RuntimeException("PHPMailerService: 'to' is required.");
            }
            $this->addRecipients($mail, 'addAddress', $message['to']);
            $this->addRecipients($mail, 'addCC', $message['cc'] ?? null);
            $this->addRecipients($mail, 'addBCC', $message['bcc'] ?? null);

            // SUBJECT
            if (empty($message['subject'])) {
                throw new \RuntimeException("PHPMailerService: 'subject' is required.");
            }
            $mail->Subject = (string) $message['subject'];

            // BODY
            if (empty($message['html'])) {
                throw new \RuntimeException("PHPMailerService: 'html' is required.");
            }
            $mail->isHTML(true);
            $mail->Body = (string) $message['html'];

            $mail->AltBody = !empty($message['text'])
                ? (string) $message['text']
                : $this->htmlToText((string) $message['html']);

            // HEADERS
            if (!empty($message['headers']) && is_array($message['headers'])) {
                foreach ($message['headers'] as $key => $val) {
                    $mail->addCustomHeader((string) $key, (string) $val);
                }
            }

            // ATTACHMENTS
            if (!empty($message['attachments']) && is_array($message['attachments'])) {
                foreach ($message['attachments'] as $att) {
                    if (isset($att['path'])) {
                        $mail->addAttachment($att['path'], $att['name'] ?? '');
                    } elseif (isset($att['string'])) {
                        $mail->addStringAttachment(
                            $att['string'],
                            $att['name'] ?? 'attachment.bin',
                            'base64',
                            $att['mime'] ?? 'application/octet-stream'
                        );
                    }
                }
            }

            $ok = $mail->send();

            return $ok
                ? ['ok' => true, 'message_id' => $mail->getLastMessageID() ?: null]
                : ['ok' => false, 'error' => $mail->ErrorInfo ?: 'Unknown error'];

        } catch (PHPMailerException $e) {
            return ['ok' => false, 'error' => $e->getMessage()];
        } catch (\Throwable $e) {
            return ['ok' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Build and configure a PHPMailer instance from config/env.
     */
    private function makeMailer(): PHPMailer
    {
        $mail = new PHPMailer(true);

        $mail->CharSet = 'UTF-8';

        $mail->isSMTP();
        $mail->Host       = (string) config('phpmailer.smtp.host');
        $mail->Port       = (int) config('phpmailer.smtp.port', 587);
        $mail->SMTPAuth   = true;
        $mail->Username   = (string) config('phpmailer.smtp.username');
        $mail->Password   = (string) config('phpmailer.smtp.password');
        $mail->Timeout    = 20;
        $mail->SMTPAutoTLS = true;

        $encryption = (string) config('phpmailer.smtp.encryption', 'tls');
        if ($encryption === 'tls') {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        } elseif ($encryption === 'ssl') {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        } else {
            $mail->SMTPSecure = false;
        }

        return $mail;
    }

    /**
     * Set the From address. Accepts:
     * - 'email@domain.com'
     * - ['email@domain.com' => 'Name']
     * - ['email@domain.com'] (name omitted)
     */
    private function setFrom(PHPMailer $mail, $from): void
    {
        if (is_string($from)) {
            $mail->setFrom($from);
            return;
        }

        if (!is_array($from) || empty($from)) {
            throw new \RuntimeException("PHPMailerService: invalid 'from' format.");
        }

        foreach ($from as $email => $name) {
            if (is_int($email)) {
                $mail->setFrom((string) $name);
            } else {
                $mail->setFrom((string) $email, (string) $name);
            }
            return; // only one from allowed
        }
    }

    /**
     * Add recipients in flexible formats:
     * - 'email@domain.com'
     * - ['a@b.com', 'c@d.com']
     * - ['a@b.com' => 'Name', 'c@d.com' => 'Name2']
     */
    private function addRecipients(PHPMailer $mail, string $method, $recipients): void
    {
        if (empty($recipients)) {
            return;
        }

        if (is_string($recipients)) {
            $mail->{$method}($recipients);
            return;
        }

        if (!is_array($recipients)) {
            throw new \RuntimeException("PHPMailerService: recipients must be string or array.");
        }

        foreach ($recipients as $key => $value) {
            if (is_int($key)) {
                $mail->{$method}((string) $value);
            } else {
                $mail->{$method}((string) $key, (string) $value);
            }
        }
    }

    /**
     * Basic HTML -> text fallback for AltBody.
     */
    private function htmlToText(string $html): string
    {
        $text = strip_tags($html);
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $text = preg_replace("/\n{3,}/", "\n\n", $text);
        return trim($text);
    }
}
