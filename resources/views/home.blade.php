@extends('layouts.front')

@section('content')

<!-- HERO -->
<section class="hero">
  <img src="{{ asset('images/hero.png') }}" alt="Vintage Rolls Royce waiting outside luxury estate" class="hero-img" />
  <div class="hero-overlay"></div>
  <div class="hero-content">
    <p class="hero-tagline">"The Personal Touch"</p>
    <h1 class="hero-h1">Unforgettable Journeys for<br>Your Perfect Day.</h1>
    <p class="hero-sub">Family-run British luxury transport since 1990. Vintage Rolls Royces, elegant Horse Drawn Carriages, and unique Rickshaws.</p>
    <div class="hero-btns">
      <a href="{{ route('fleet') }}"   class="btn btn-gold">View Our Fleet</a>
      <a href="{{ route('contact') }}" class="btn btn-outline-white">Enquire Now</a>
    </div>
  </div>
</section>

<!-- VEHICLES SECTION -->
<section class="section">
  <div class="container">
    <div class="page-intro reveal">
      <p class="eyebrow">Our Vehicles</p>
      <h2 style="font-family:var(--serif);font-size:clamp(2rem,5vw,3.2rem)">Arrive in True Style</h2>
      <p style="margin-top:1rem">Whether you desire the timeless elegance of a vintage Rolls Royce, the fairy tale romance of a horse drawn carriage, or a quirky entrance in a luxury rickshaw, we have the perfect transport to complement your wedding.</p>
    </div>

    <div class="vehicle-grid">
      <div class="vehicle-card reveal">
        <img src="{{ asset('images/luxury-1.png') }}" alt="Luxury Wedding Car" />
        <div class="vehicle-card-overlay"></div>
        <div class="vehicle-card-body">
          <h4>Luxury Cars</h4>
          <p>From Vintage Rolls Royce to modern Bentleys and Phantoms.</p>
          <a href="{{ route('fleet.luxury-cars') }}" class="vehicle-card-link">Explore Cars</a>
        </div>
      </div>
      <div class="vehicle-card reveal reveal-delay-1">
        <img src="{{ asset('images/horse-1.png') }}" alt="Horse Drawn Carriage" />
        <div class="vehicle-card-overlay"></div>
        <div class="vehicle-card-body">
          <h4>Horse Drawn Carriage</h4>
          <p>Like Cinderella, travel in truly classic fairy tale style.</p>
          <a href="{{ route('fleet.horse-drawn-carriage') }}" class="vehicle-card-link">Explore Carriages</a>
        </div>
      </div>
      <div class="vehicle-card reveal reveal-delay-2">
        <img src="{{ asset('images/rickshaw-1.png') }}" alt="Wedding Rickshaw" />
        <div class="vehicle-card-overlay"></div>
        <div class="vehicle-card-body">
          <h4>Rickshaws</h4>
          <p>Travel in style with our unique and vibrant tuk-tuks.</p>
          <a href="{{ route('fleet.rickshaw') }}" class="vehicle-card-link">Explore Rickshaws</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ABOUT SECTION -->
<section class="section section-card">
  <div class="container">
    <div class="page-intro reveal" style="margin-bottom:4rem">
      <p class="eyebrow">Established 1990</p>
      <h2 style="font-family:var(--serif);font-size:clamp(2rem,4vw,3rem)">Trusted by Generations.</h2>
    </div>
    <div class="home-about">
      <div class="home-about-img reveal">
        <div class="aspect">
          <img src="{{ asset('images/about.png') }}" alt="Wedding couple with car" />
        </div>
        <div class="badge-years">
          <div class="num">35</div>
          <div class="label">Years of<br>Excellence</div>
        </div>
      </div>
      <div class="reveal reveal-delay-1">
        <p style="color:var(--muted);font-size:1.05rem;margin-bottom:1rem">A Star Limousine is a family-run business based in Stanmore, Middlesex. For over three decades, we have provided an uncompromised level of luxury and reliability for weddings and special events.</p>
        <p style="color:var(--muted);font-size:1.05rem">We understand the complications in arranging weddings. Our experienced staff are here to advise you on the best vehicle for your needs, ensuring your journey is seamless, comfortable, and memorable.</p>
        <a href="{{ route('about') }}" class="btn btn-outline" style="margin-top:2rem">Discover Our Story</a>
      </div>
    </div>
  </div>
</section>

<!-- CTA BANNER -->
<section class="cta-banner">
  <img src="{{ asset('images/luxury-1.png') }}" alt="" class="cta-banner-bg" />
  <div class="cta-banner-overlay"></div>
  <div class="cta-banner-content reveal">
    <h2>Ready to Book Your Dream Car?</h2>
    <p>Contact our team today to discuss your requirements, check availability, and receive a personalised quote. We can arrange chocolates, flowers, or champagne for your journey.</p>
    <a href="{{ route('contact') }}" class="btn btn-gold">Get in Touch</a>
  </div>
</section>

@endsection

@push('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "@id": "{{ url('/') }}#website",
  "name": "A Star Limousine",
  "url": "{{ url('/') }}"
}
</script>
@endpush
