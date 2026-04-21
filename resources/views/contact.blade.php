@extends('layouts.front')

@section('title', 'Contact — A Star Limousine')
@section('description', 'Contact A Star Limousine to enquire about our luxury wedding transport. Call, email, or send us a message.')

@section('content')

<div class="page-wrap">
  <section class="section">
    <div class="container">

      <div class="page-intro reveal">
        <p class="eyebrow">Get In Touch</p>
        <h1>Contact Us</h1>
        <div class="divider" style="margin:1.25rem auto 1rem"></div>
        <p>Our fully trained staff are always happy to advise you on the best vehicle to suit your needs. Please get in touch — we would love to help you make your special day truly unforgettable.</p>
      </div>

      <div class="contact-grid" style="max-width:64rem;margin:0 auto">

        <!-- Contact details -->
        <div class="reveal">
          <h2 style="font-family:var(--serif);font-size:1.6rem;margin-bottom:2rem">How to Reach Us</h2>

          <div class="contact-detail">
            <div class="contact-icon">
              <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.00 1.18 2 2 0 012 .00h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 14z"/></svg>
            </div>
            <div>
              <p class="contact-label">Phone</p>
              <div class="contact-value" style="display:flex;flex-direction:column;gap:.6rem">

                <div style="display:flex;align-items:center;gap:.75rem;flex-wrap:wrap">
                  <a href="tel:07956392801">07956 39 28 01</a>
                  <a href="https://wa.me/447956392801" target="_blank" rel="noopener" title="WhatsApp" style="display:inline-flex;align-items:center;gap:.3rem;font-size:.65rem;text-transform:uppercase;letter-spacing:.1em;color:var(--muted);border:1px solid var(--border);padding:.2rem .6rem;transition:color .2s,border-color .2s" onmouseover="this.style.color='#25D366';this.style.borderColor='#25D366'" onmouseout="this.style.color='var(--muted)';this.style.borderColor='var(--border)'">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    WhatsApp
                  </a>
                </div>

                <div style="display:flex;align-items:center;gap:.75rem;flex-wrap:wrap">
                  <a href="tel:07890396875">07890 39 68 75</a>
                  <a href="https://wa.me/447890396875" target="_blank" rel="noopener" title="WhatsApp" style="display:inline-flex;align-items:center;gap:.3rem;font-size:.65rem;text-transform:uppercase;letter-spacing:.1em;color:var(--muted);border:1px solid var(--border);padding:.2rem .6rem;transition:color .2s,border-color .2s" onmouseover="this.style.color='#25D366';this.style.borderColor='#25D366'" onmouseout="this.style.color='var(--muted)';this.style.borderColor='var(--border)'">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    WhatsApp
                  </a>
                </div>

              </div>
            </div>
          </div>

          <div class="contact-detail">
            <div class="contact-icon">
              <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            </div>
            <div>
              <p class="contact-label">Email</p>
              <div class="contact-value">
                <a href="mailto:info@astarlimousine.co.uk">info@astarlimousine.co.uk</a>
              </div>
            </div>
          </div>

          <div class="contact-detail">
            <div class="contact-icon">
              <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
            </div>
            <div>
              <p class="contact-label">Address</p>
              <div class="contact-value">
                <span>68 Weston Drive<br>Stanmore, Middlesex<br>HA7 2ES</span>
              </div>
            </div>
          </div>

          <div style="border-top:1px solid var(--border);padding-top:2.5rem;margin-top:1rem">
            <h3 style="font-family:var(--serif);font-size:1.2rem;margin-bottom:1rem">Our Promise</h3>
            <p style="color:var(--muted);font-size:.95rem;line-height:1.8">Established in 1990, we are a family-run business built on trust, reliability, and exceptional personal service. Whatever your occasion — a wedding, anniversary, or other special event — we will work with you to ensure every detail is perfect.</p>
            <p style="color:var(--muted);font-size:.95rem;line-height:1.8;margin-top:1rem">We can also arrange champagne, chocolates, or flowers to be provided for you upon collection.</p>
          </div>
        </div>

        <!-- Enquiry Form -->
        <div class="reveal reveal-delay-1">
          <div class="contact-form-wrap" id="form-wrap">
            <h2>Send an Enquiry</h2>
            <form id="enquiry-form" action="{{ route('contact.submit') }}" method="POST" novalidate>
              @csrf
              <div class="form-row">
                <div class="form-group">
                  <label for="f-name">Name</label>
                  <input id="f-name" name="name" type="text" placeholder="Your full name" autocomplete="name" />
                  <div class="form-error" id="f-name-error" data-msg="Please enter your name"></div>
                </div>
                <div class="form-group">
                  <label for="f-phone">Phone Number</label>
                  <input id="f-phone" name="phone" type="tel" placeholder="Your phone number" autocomplete="tel" />
                  <div class="form-error" id="f-phone-error" data-msg="Please enter a valid phone number"></div>
                </div>
              </div>
              <div class="form-group">
                <label for="f-email">Email Address</label>
                <input id="f-email" name="email" type="email" placeholder="your@email.com" autocomplete="email" />
                <div class="form-error" id="f-email-error" data-msg="Please enter a valid email address"></div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label for="f-vehicle">Vehicle Type</label>
                  <select id="f-vehicle" name="vehicle">
                    <option value="">Select vehicle...</option>
                    <option value="luxury-car">Luxury Car</option>
                    <option value="horse-drawn-carriage">Horse Drawn Carriage</option>
                    <option value="rickshaw">Rickshaw</option>
                  </select>
                  <div class="form-error" id="f-vehicle-error" data-msg="Please select a vehicle type"></div>
                </div>
                <div class="form-group">
                  <label for="f-date">Event Date</label>
                  <input id="f-date" name="date" type="date" />
                  <div class="form-error" id="f-date-error" data-msg="Please enter your event date"></div>
                </div>
              </div>
              <div class="form-group">
                <label for="f-message">Additional Information</label>
                <textarea id="f-message" name="message" placeholder="Tell us about your event — venue, number of passengers, any special requests..."></textarea>
                <div class="form-error" id="f-message-error" data-msg="Please provide some additional information"></div>
              </div>
              <button type="submit" class="btn btn-gold form-submit">Send Enquiry</button>
            </form>
          </div>

          <div class="form-success" id="form-success">
            <svg width="56" height="56" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            <h3>Thank You</h3>
            <p>Your enquiry has been received. We will be in touch very shortly to discuss your requirements and help plan your special day.</p>
            <p class="tagline">"The Personal Touch"</p>
          </div>
        </div>

      </div>
    </div>
  </section>
</div>

@endsection
