@extends('layouts.front')

@section('content')

<div class="page-wrap">
  <section class="section">
    <div class="container">
      <div style="text-align:center;margin-bottom:4rem" class="reveal">
        <p style="color:var(--gold);font-size:.7rem;text-transform:uppercase;letter-spacing:.18em;margin-bottom:1rem">Legal</p>
        <h1 style="font-family:var(--serif);font-size:clamp(2rem,5vw,3.5rem);margin-bottom:1rem">Terms of Service</h1>
        <div class="divider" style="margin:0 auto 1rem"></div>
        <p class="legal-meta">Last updated: April 2025</p>
      </div>

      <div class="legal-body reveal">

        <section>
          <h2>1. Introduction</h2>
          <p>Welcome to A Star Limousine. These Terms of Service ("Terms") govern your use of our services, including all vehicle hire bookings, enquiries, and communications with us. By making a booking or enquiry, you agree to be bound by these Terms. Please read them carefully.</p>
          <p>A Star Limousine is a family-run business based at 68 Weston Drive, Stanmore, Middlesex, HA7 2ES. We have been providing luxury wedding and event transport since 1990.</p>
        </section>

        <section>
          <h2>2. Bookings and Confirmation</h2>
          <p>All bookings are subject to availability and are only confirmed upon receipt of a deposit as agreed between A Star Limousine and the client. A booking confirmation will be provided in writing (by email or letter) once the deposit has been received.</p>
          <p>It is the client's responsibility to ensure all details provided at the time of booking are accurate, including the event date, time, venue, and number of passengers. A Star Limousine cannot be held liable for any issues arising from incorrect information.</p>
        </section>

        <section>
          <h2>3. Deposits and Payment</h2>
          <p>A non-refundable deposit is required to secure your booking. The exact deposit amount will be confirmed at the time of enquiry. The remaining balance is due no later than 14 days prior to the event date, unless otherwise agreed in writing.</p>
          <p>Failure to pay the balance by the agreed date may result in your booking being released. Payment can be made by bank transfer or other methods as agreed. All prices quoted include VAT where applicable.</p>
        </section>

        <section>
          <h2>4. Cancellations</h2>
          <p>Should you need to cancel your booking, please notify us in writing as soon as possible. The following cancellation policy applies:</p>
          <ul>
            <li>Cancellations made more than 90 days before the event: deposit forfeited only.</li>
            <li>Cancellations made 31–90 days before the event: 50% of the total booking value.</li>
            <li>Cancellations made 14–30 days before the event: 75% of the total booking value.</li>
            <li>Cancellations made fewer than 14 days before the event: 100% of the total booking value.</li>
          </ul>
          <p>We strongly recommend taking out wedding insurance to protect against unforeseen circumstances.</p>
        </section>

        <section>
          <h2>5. Conduct and Responsibilities</h2>
          <p>The client is responsible for the behaviour of all passengers travelling in the vehicle. Any damage caused to the vehicle by passengers will be the financial responsibility of the client. A Star Limousine reserves the right to terminate a journey if any passenger's conduct is deemed unsafe or inappropriate.</p>
          <p>Smoking is strictly prohibited in all our vehicles. The consumption of food is not permitted without prior written agreement. Alcohol may be consumed in accordance with UK law by passengers aged 18 and over.</p>
        </section>

        <section>
          <h2>6. Punctuality and Delays</h2>
          <p>A Star Limousine will make every effort to arrive at the agreed time. However, we cannot accept liability for delays caused by circumstances beyond our control, including but not limited to extreme weather conditions, traffic accidents, road closures, or mechanical failures.</p>
          <p>In the unlikely event of a vehicle breakdown, we will endeavour to provide an alternative vehicle of equal or comparable standard. Our liability will be limited to the return of any monies paid for the affected journey.</p>
        </section>

        <section>
          <h2>7. Photographs and Marketing</h2>
          <p>A Star Limousine may, from time to time, take photographs or video footage at events for use in our marketing materials and website. Should you wish to opt out, please notify us in writing prior to your event. We will not publish any images that can identify individuals without their express consent.</p>
        </section>

        <section>
          <h2>8. Limitation of Liability</h2>
          <p>To the fullest extent permitted by applicable law, A Star Limousine's total liability to you in connection with any booking shall not exceed the total amount paid by you for that booking. We shall not be liable for any indirect, consequential, or incidental loss.</p>
        </section>

        <section>
          <h2>9. Governing Law</h2>
          <p>These Terms shall be governed by and construed in accordance with the laws of England and Wales. Any disputes arising under these Terms shall be subject to the exclusive jurisdiction of the courts of England and Wales.</p>
        </section>

        <section>
          <h2>10. Contact</h2>
          <p>If you have any questions about these Terms, please contact us:</p>
          <ul style="list-style:none;padding-left:0">
            <li><span class="text-white">Phone:</span> 07956 39 28 01 / 07890 39 68 75</li>
            <li><span class="text-white">Email:</span> <a href="mailto:info@astarlimousine.co.uk">info@astarlimousine.co.uk</a></li>
            <li><span class="text-white">Address:</span> 68 Weston Drive, Stanmore, Middlesex, HA7 2ES</li>
          </ul>
        </section>

        <div class="legal-crosslink">
          <a href="{{ route('privacy') }}">View our Privacy Policy &rarr;</a>
        </div>

      </div>
    </div>
  </section>
</div>

@endsection
