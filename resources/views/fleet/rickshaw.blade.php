@extends('layouts.front')

@section('content')

<!-- PAGE HERO -->
<div class="page-hero">
  <img src="{{ asset('images/rickshaw-hero.png') }}" alt="Wedding Rickshaw Tuk Tuk" />
  <div class="page-hero-overlay"></div>
  <div class="page-hero-content">
    <p class="page-hero-eyebrow">Our Fleet</p>
    <h1 class="page-hero-title">Rickshaw</h1>
    <div class="divider"></div>
  </div>
</div>

<div class="page-wrap" style="padding-top:0">
  <section class="section">
    <div class="container">

      <!-- Intro -->
      <div class="page-intro reveal">
        <p class="eyebrow">Travel In Style</p>
        <h2>A Unique &amp; Unforgettable Way to Arrive</h2>
        <p>For those looking for something truly different — something that will have your guests talking long after the day is done — our beautifully decorated rickshaw is the perfect choice.</p>
        <p style="margin-top:1rem">Our fully trained staff are always happy to advise you on the best vehicle to suit your needs, taking into account both the practicality and the nature of your event.</p>
      </div>

      <!-- Gallery 2-col -->
      <div class="gallery-grid gallery-grid-2 reveal">
        <div class="gallery-item">
          <img src="{{ asset('images/rickshaw-1.png') }}" alt="Decorated wedding rickshaw" />
          <div class="gallery-item-overlay" style="opacity:1"></div>
          <div class="gallery-item-caption" style="transform:translateY(0)">
            <h3>Beautifully Decorated Rickshaw</h3>
          </div>
        </div>
        <div class="gallery-item">
          <img src="{{ asset('images/rickshaw-2.png') }}" alt="Colourful tuk-tuk for celebrations" />
          <div class="gallery-item-overlay" style="opacity:1"></div>
          <div class="gallery-item-caption" style="transform:translateY(0)">
            <h3>Vibrant Celebration Transport</h3>
          </div>
        </div>
        <div class="gallery-item">
          <img src="{{ asset('images/rickshaw-3.png') }}" alt="Rickshaw with garlands and lights" />
          <div class="gallery-item-overlay" style="opacity:1"></div>
          <div class="gallery-item-caption" style="transform:translateY(0)">
            <h3>Festival Style with Marigolds</h3>
          </div>
        </div>
        <div class="gallery-item">
          <img src="{{ asset('images/rickshaw-hero.png') }}" alt="Wedding rickshaw arrival" />
          <div class="gallery-item-overlay" style="opacity:1"></div>
          <div class="gallery-item-caption" style="transform:translateY(0)">
            <h3>A Show-Stopping Entrance</h3>
          </div>
        </div>
      </div>

      <!-- Quote -->
      <div class="quote-callout reveal">
        <div class="divider" style="margin:0 auto 2rem"></div>
        <blockquote>"A wonderfully joyful, show-stopping entrance that is completely one-of-a-kind."</blockquote>
        <p>Decorated with care and attention, our rickshaw can be personalised to match your wedding theme and colours.</p>
      </div>

      <!-- CTA -->
      <div style="text-align:center;border-top:1px solid var(--border);padding-top:5rem" class="reveal">
        <h3 style="font-family:var(--serif);font-size:clamp(1.75rem,3vw,2.5rem);margin-bottom:1rem">Interested in Our Rickshaw?</h3>
        <p style="color:var(--muted);max-width:34rem;margin:0 auto 2.5rem">Get in touch and we will be delighted to discuss your event and how we can make your arrival truly unforgettable.</p>
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
      { "@type": "ListItem", "position": 3, "name": "Rickshaw", "item": "{{ url('/fleet/rickshaw') }}" }
    ]
  },
  {
    "@context": "https://schema.org",
    "@type": "Service",
    "name": "Wedding Rickshaw Hire",
    "description": "Wedding rickshaw and tuk tuk hire in London and Middlesex. Perfect for Asian weddings — a beautiful, show-stopping entrance your guests will never forget.",
    "url": "{{ url('/fleet/rickshaw') }}",
    "provider": { "@id": "{{ url('/') }}#business" },
    "areaServed": [
      { "@type": "City", "name": "London" },
      { "@type": "AdministrativeArea", "name": "Middlesex" }
    ],
    "serviceType": "Rickshaw Hire"
  }
]
</script>
@endpush
