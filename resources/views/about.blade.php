@extends('layouts.front')

@section('title', 'About Us — A Star Limousine')
@section('description', 'Learn about A Star Limousine, a family-run British luxury wedding transport business established in 1990 in Stanmore, Middlesex.')

@section('content')

<div class="page-wrap">

  <section class="section">
    <div class="container">
      <div class="page-intro reveal">
        <h1>Our Heritage</h1>
        <div class="divider" style="margin:1.25rem auto 0"></div>
      </div>

      <!-- Section 1: Family Run -->
      <div class="two-col" style="margin-bottom:7rem">
        <div class="two-col-img reveal">
          <img src="{{ asset('images/about.png') }}" alt="A Star Limousine History" />
          <div class="ring"></div>
        </div>
        <div class="two-col-text reveal reveal-delay-1">
          <h2>Family Run Since 1990</h2>
          <p>A Star Limousine is a proudly family-run British luxury transport business. For over three decades, we have been trusted to make the most important days of people's lives truly unforgettable.</p>
          <p>Based in Stanmore, Middlesex, we have built a reputation on reliability, exceptional presentation, and what we proudly call "The Personal Touch." When you book with us, you are not just hiring a vehicle; you are receiving the dedication of a family that cares deeply about your special day.</p>
          <p>We understand the complications in arranging weddings and special events. Our experienced staff are always on hand to advise on the best vehicle for your needs, timing logistics, and those extra special details.</p>
        </div>
      </div>

      <!-- Section 2: Personal Touch -->
      <div class="two-col" style="margin-bottom:7rem">
        <div class="two-col-text reveal" style="order:1">
          <h2>The Personal Touch</h2>
          <p>Every journey with A Star Limousine is bespoke. Our chauffeurs are highly trained, impeccably dressed, and understand the etiquette required for prestigious events.</p>
          <p>To make your journey even more special, we can organise fine chocolates, elegant floral arrangements, or chilled champagne upon collection. The interior of your chosen vehicle will be pristine, and we offer a choice of ribbon colours to match your wedding theme.</p>
          <a href="{{ route('contact') }}" class="btn btn-gold">Contact Us</a>
        </div>
        <div class="two-col-img reveal reveal-delay-1" style="order:2">
          <img src="{{ asset('images/luxury-3.png') }}" alt="Luxury interior detail" />
          <div class="ring"></div>
        </div>
      </div>
    </div>
  </section>

</div>

@endsection
