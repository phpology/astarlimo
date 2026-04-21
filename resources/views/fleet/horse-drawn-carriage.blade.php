@extends('layouts.front')

@section('title', 'Horse Drawn Carriage — A Star Limousine')
@section('description', 'Arrive at your wedding like Cinderella in a beautifully decorated horse-drawn carriage. A truly fairy tale arrival.')

@section('content')

<!-- PAGE HERO -->
<div class="page-hero">
  <img src="{{ asset('images/horse-carriage-hero.png') }}" alt="Horse Drawn Wedding Carriage" />
  <div class="page-hero-overlay"></div>
  <div class="page-hero-content">
    <p class="page-hero-eyebrow">Our Fleet</p>
    <h1 class="page-hero-title">Horse Drawn Carriage</h1>
    <div class="divider"></div>
  </div>
</div>

<div class="page-wrap" style="padding-top:0">
  <section class="section">
    <div class="container">

      <!-- Intro -->
      <div class="page-intro reveal">
        <p class="eyebrow">A Fairy Tale Come True</p>
        <h2>Like Cinderella and Her Prince Charming, You Too Could Travel in Truly Classic Style</h2>
        <p>There is nothing quite like arriving at your wedding in a beautifully decorated horse-drawn carriage. Gentle, graceful, and timelessly romantic — it is a moment that will be remembered and talked about for years to come.</p>
        <p style="margin-top:1rem">Our fully trained staff are always happy to advise you on the best carriage to suit your needs, taking into account both practicality and the nature of your event.</p>
      </div>

      <!-- Gallery 2-col -->
      <div class="gallery-grid gallery-grid-2 reveal">
        <div class="gallery-item">
          <img src="{{ asset('images/horse-1.png') }}" alt="Elegant white horse-drawn carriage" />
          <div class="gallery-item-overlay" style="opacity:1"></div>
          <div class="gallery-item-caption" style="transform:translateY(0)">
            <h3>Classic White Landau Carriage</h3>
          </div>
        </div>
        <div class="gallery-item">
          <img src="{{ asset('images/horse-2.png') }}" alt="Cinderella horse-drawn carriage at sunset" />
          <div class="gallery-item-overlay" style="opacity:1"></div>
          <div class="gallery-item-caption" style="transform:translateY(0)">
            <h3>Fairy Tale Evening Arrival</h3>
          </div>
        </div>
        <div class="gallery-item">
          <img src="{{ asset('images/horse-carriage-hero.png') }}" alt="Horse-drawn wedding carriage" />
          <div class="gallery-item-overlay" style="opacity:1"></div>
          <div class="gallery-item-caption" style="transform:translateY(0)">
            <h3>Traditional English Wedding</h3>
          </div>
        </div>
        <div class="gallery-item">
          <img src="{{ asset('images/about.png') }}" alt="Horse carriage in the countryside" />
          <div class="gallery-item-overlay" style="opacity:1"></div>
          <div class="gallery-item-caption" style="transform:translateY(0)">
            <h3>Country Estate Setting</h3>
          </div>
        </div>
      </div>

      <!-- Quote -->
      <div class="quote-callout reveal">
        <div class="divider" style="margin:0 auto 2rem"></div>
        <blockquote>"The most romantic arrival imaginable — your own fairy tale, brought to life."</blockquote>
        <p>We can also arrange for champagne, chocolates, or flowers to be provided for you upon collection — to make your journey truly magical.</p>
      </div>

      <!-- CTA -->
      <div style="text-align:center;border-top:1px solid var(--border);padding-top:5rem" class="reveal">
        <h3 style="font-family:var(--serif);font-size:clamp(1.75rem,3vw,2.5rem);margin-bottom:1rem">Ready to Book Your Carriage?</h3>
        <p style="color:var(--muted);max-width:34rem;margin:0 auto 2.5rem">Contact us today — we would be delighted to discuss your requirements and make your fairy tale a reality.</p>
        <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
          <a href="{{ route('contact') }}" class="btn btn-gold">Make an Enquiry</a>
          <a href="{{ route('fleet') }}" class="back-link">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
            Back to Fleet
          </a>
        </div>
      </div>

    </div>
  </section>
</div>

@endsection
