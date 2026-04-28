@extends('layouts.front')

@section('content')

<!-- PAGE HERO -->
<div class="page-hero">
  <img src="{{ asset('images/gdv01-hero.jpg') }}" alt="Luxury Wedding Cars" />
  <div class="page-hero-overlay"></div>
  <div class="page-hero-content">
    <p class="page-hero-eyebrow">Our Fleet</p>
    <h1 class="page-hero-title">Luxury Cars</h1>
    <div class="divider"></div>
  </div>
</div>

<div class="page-wrap" style="padding-top:0">
  <section class="section">
    <div class="container">

      <div class="page-intro reveal">
        <h2>A Range of Cars to Suit All Budgets — From Vintage to Modern</h2>
        <p>Our fully trained staff are always happy to advise you on the best wedding vehicle to suit your needs, taking into account both practicality and the nature of your event.</p>
      </div>

      <!-- Gallery -->
      <div class="gallery-grid reveal">
        <div class="gallery-item">
          <img src="{{ asset('images/luxury-1.png') }}" alt="Vintage Rolls Royce Silver Spirit" />
          <div class="gallery-item-overlay"></div>
          <div class="gallery-item-caption">
            <h3>Vintage Rolls Royce Silver Spirit</h3>
            <p>A timeless classic. The Silver Spirit embodies six decades of British craftsmanship — impeccable in white with ribbon.</p>
          </div>
        </div>
        <div class="gallery-item">
          <img src="{{ asset('images/luxury-2.png') }}" alt="Rolls Royce Phantom" />
          <div class="gallery-item-overlay"></div>
          <div class="gallery-item-caption">
            <h3>Rolls Royce Phantom</h3>
            <p>The pinnacle of modern luxury. The Phantom commands presence wherever it arrives.</p>
          </div>
        </div>
        <div class="gallery-item">
          <img src="{{ asset('images/luxury-3.png') }}" alt="Classic Silver Shadow" />
          <div class="gallery-item-overlay"></div>
          <div class="gallery-item-caption">
            <h3>Classic Silver Shadow</h3>
            <p>An icon of elegance. Polished chrome and hand-crafted interiors make every journey special.</p>
          </div>
        </div>
        <div class="gallery-item">
          <img src="{{ asset('images/luxury-4.png') }}" alt="Bentley Flying Spur" />
          <div class="gallery-item-overlay"></div>
          <div class="gallery-item-caption">
            <h3>Bentley Flying Spur</h3>
            <p>Power, grace, and peerless refinement — the Bentley is the choice for those who demand the very best.</p>
          </div>
        </div>
        <div class="gallery-item">
          <img src="{{ asset('images/luxury-5.png') }}" alt="Bentley Mulsanne" />
          <div class="gallery-item-overlay"></div>
          <div class="gallery-item-caption">
            <h3>Bentley Mulsanne</h3>
            <p>The grand touring flagship. Arrive at your wedding in the car that defines British luxury.</p>
          </div>
        </div>
      </div>

      <!-- CTA -->
      <div style="text-align:center;border-top:1px solid var(--border);padding-top:5rem" class="reveal">
        <h3 style="font-family:var(--serif);font-size:clamp(1.75rem,3vw,2.5rem);margin-bottom:1rem">Ready to Book?</h3>
        <p style="color:var(--muted);max-width:32rem;margin:0 auto 2.5rem">Get in touch today and let us help you choose the perfect vehicle for your special day.</p>
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

@push('schema')
<script type="application/ld+json">
[
  {
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
      { "@type": "ListItem", "position": 1, "name": "Home", "item": "{{ url('/') }}" },
      { "@type": "ListItem", "position": 2, "name": "Our Fleet", "item": "{{ url('/fleet') }}" },
      { "@type": "ListItem", "position": 3, "name": "Luxury Cars", "item": "{{ url('/fleet/luxury-cars') }}" }
    ]
  },
  {
    "@context": "https://schema.org",
    "@type": "Service",
    "name": "Luxury Wedding Car Hire",
    "description": "Hire a Vintage Rolls Royce, Bentley or Phantom for your wedding. Luxury wedding car hire across London and Middlesex. Call us to check availability.",
    "url": "{{ url('/fleet/luxury-cars') }}",
    "provider": { "@id": "{{ url('/') }}#business" },
    "areaServed": [
      { "@type": "City", "name": "London" },
      { "@type": "AdministrativeArea", "name": "Middlesex" }
    ],
    "serviceType": "Wedding Car Hire",
    "hasOfferCatalog": {
      "@type": "OfferCatalog",
      "name": "Luxury Cars",
      "itemListElement": [
        { "@type": "Offer", "itemOffered": { "@type": "Product", "name": "Vintage Rolls Royce Silver Spirit" } },
        { "@type": "Offer", "itemOffered": { "@type": "Product", "name": "Rolls Royce Phantom" } },
        { "@type": "Offer", "itemOffered": { "@type": "Product", "name": "Classic Silver Shadow" } },
        { "@type": "Offer", "itemOffered": { "@type": "Product", "name": "Bentley Flying Spur" } },
        { "@type": "Offer", "itemOffered": { "@type": "Product", "name": "Bentley Mulsanne" } }
      ]
    }
  }
]
</script>
@endpush
