@extends('layouts.front')

@section('content')

<div class="page-wrap">
  <section class="section">
    <div class="container">
      <div style="text-align:center;margin-bottom:4rem" class="reveal">
        <p style="color:var(--gold);font-size:.7rem;text-transform:uppercase;letter-spacing:.18em;margin-bottom:1rem">Legal</p>
        <h1 style="font-family:var(--serif);font-size:clamp(2rem,5vw,3.5rem);margin-bottom:1rem">Privacy Policy</h1>
        <div class="divider" style="margin:0 auto 1rem"></div>
        <p class="legal-meta">Last updated: April 2025</p>
      </div>

      <div class="legal-body reveal">

        <section>
          <h2>1. Who We Are</h2>
          <p>A Star Limousine ("we", "us", "our") is a family-run business providing luxury wedding and event transport. We are the data controller for the personal data you provide to us. Our registered address is 68 Weston Drive, Stanmore, Middlesex, HA7 2ES.</p>
          <p>We are committed to protecting your privacy and handling your personal data in a transparent and responsible manner, in accordance with the UK General Data Protection Regulation (UK GDPR) and the Data Protection Act 2018.</p>
        </section>

        <section>
          <h2>2. Data We Collect</h2>
          <p>We may collect and process the following personal data:</p>
          <ul>
            <li><span class="text-white">Identity data:</span> your name.</li>
            <li><span class="text-white">Contact data:</span> email address, telephone number, and postal address.</li>
            <li><span class="text-white">Booking data:</span> event date, venue, vehicle preference, number of passengers, and any special requests.</li>
            <li><span class="text-white">Financial data:</span> payment details necessary to process deposits and balances (we do not store card details).</li>
            <li><span class="text-white">Communications data:</span> records of your correspondence with us.</li>
          </ul>
          <p>We do not collect any special category data (such as health information) unless voluntarily provided for the purpose of accommodating specific needs.</p>
        </section>

        <section>
          <h2>3. How We Collect Your Data</h2>
          <p>We collect your data through:</p>
          <ul>
            <li>Enquiry forms on our website</li>
            <li>Telephone and email conversations</li>
            <li>WhatsApp messages</li>
            <li>In-person meetings or events</li>
          </ul>
        </section>

        <section>
          <h2>4. How We Use Your Data</h2>
          <p>We use your personal data to:</p>
          <ul>
            <li>Process and manage your booking</li>
            <li>Communicate with you about your enquiry or booking</li>
            <li>Process payments and issue receipts</li>
            <li>Comply with our legal and regulatory obligations</li>
            <li>Improve our services based on feedback</li>
          </ul>
          <p>We will only send you marketing communications if you have given us explicit consent to do so. You can withdraw this consent at any time by contacting us.</p>
        </section>

        <section>
          <h2>5. Lawful Basis for Processing</h2>
          <p>We process your personal data on the following lawful bases:</p>
          <ul>
            <li><span class="text-white">Contract:</span> processing is necessary to fulfil a booking or to take steps prior to entering into a booking.</li>
            <li><span class="text-white">Legal obligation:</span> processing is necessary to comply with applicable law.</li>
            <li><span class="text-white">Legitimate interests:</span> processing is necessary for the legitimate interests of running our business, provided those interests are not overridden by your rights.</li>
            <li><span class="text-white">Consent:</span> where you have given us clear consent to process your data for a specific purpose.</li>
          </ul>
        </section>

        <section>
          <h2>6. Data Sharing</h2>
          <p>We do not sell, rent, or trade your personal data to third parties. We may share your data with trusted service providers who assist us in operating our business (for example, payment processors), but only to the extent necessary and always under appropriate data processing agreements.</p>
          <p>We may also disclose your data where required to do so by law, court order, or regulatory authority.</p>
        </section>

        <section>
          <h2>7. Data Retention</h2>
          <p>We retain your personal data for as long as necessary to fulfil the purposes for which it was collected, including any legal, accounting, or reporting requirements. Booking records are typically retained for 7 years following the event date in accordance with HMRC requirements. Enquiry records are retained for 2 years.</p>
        </section>

        <section>
          <h2>8. Your Rights</h2>
          <p>Under UK data protection law, you have the following rights:</p>
          <ul>
            <li><span class="text-white">Right of access:</span> to request a copy of the personal data we hold about you.</li>
            <li><span class="text-white">Right to rectification:</span> to request that we correct any inaccurate data.</li>
            <li><span class="text-white">Right to erasure:</span> to request deletion of your data where we no longer have a legitimate reason to hold it.</li>
            <li><span class="text-white">Right to restrict processing:</span> to request that we limit how we use your data.</li>
            <li><span class="text-white">Right to data portability:</span> to receive your data in a structured, commonly used format.</li>
            <li><span class="text-white">Right to object:</span> to object to processing based on our legitimate interests.</li>
          </ul>
          <p>To exercise any of these rights, please contact us using the details below. We will respond within one calendar month. If you are not satisfied with our response, you have the right to lodge a complaint with the Information Commissioner's Office (ICO) at <a href="https://ico.org.uk" target="_blank" rel="noopener">ico.org.uk</a>.</p>
        </section>

        <section>
          <h2>9. Cookies</h2>
          <p>Our website currently uses no tracking cookies or third-party analytics. The only data stored locally is to support the function of the enquiry form. We will update this policy should our cookie use change.</p>
        </section>

        <section>
          <h2>10. Contact Us</h2>
          <p>If you have any questions about this Privacy Policy or wish to exercise your rights, please contact us:</p>
          <ul style="list-style:none;padding-left:0">
            <li><span class="text-white">Phone:</span> 07956 39 28 01 / 07890 39 68 75</li>
            <li><span class="text-white">Email:</span> <a href="mailto:info@astarlimousine.co.uk">info@astarlimousine.co.uk</a></li>
            <li><span class="text-white">Address:</span> 68 Weston Drive, Stanmore, Middlesex, HA7 2ES</li>
          </ul>
        </section>

        <div class="legal-crosslink">
          <a href="{{ route('terms') }}">View our Terms of Service &rarr;</a>
        </div>

      </div>
    </div>
  </section>
</div>

@endsection
