<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>{{ $og['title'] ?? 'A Star Limousine — Luxury Wedding Transport Since 1990' }}</title>
  <meta name="description" content="{{ $og['description'] ?? 'Family-run British luxury wedding transport since 1990. Vintage Rolls Royces, Horse Drawn Carriages, and Rickshaws. Based in Stanmore, Middlesex.' }}" />
  <link rel="canonical" href="{{ $og['url'] ?? url()->current() }}" />

  {{-- Open Graph --}}
  <meta property="og:site_name"   content="A Star Limousine" />
  <meta property="og:locale"      content="en_GB" />
  <meta property="og:type"        content="{{ $og['type']        ?? 'website' }}" />
  <meta property="og:url"         content="{{ $og['url']         ?? url()->current() }}" />
  <meta property="og:title"       content="{{ $og['title']       ?? 'A Star Limousine — Luxury Wedding Transport Since 1990' }}" />
  <meta property="og:description" content="{{ $og['description'] ?? 'Family-run British luxury wedding transport since 1990. Vintage Rolls Royces, Horse Drawn Carriages, and Rickshaws.' }}" />
  <meta property="og:image"       content="{{ $og['image']       ?? asset('images/hero.png') }}" />
  <meta property="og:image:width"  content="1200" />
  <meta property="og:image:height" content="630" />

  {{-- Twitter / X Cards --}}
  <meta name="twitter:card"        content="summary_large_image" />
  <meta name="twitter:title"       content="{{ $og['title']       ?? 'A Star Limousine — Luxury Wedding Transport Since 1990' }}" />
  <meta name="twitter:description" content="{{ $og['description'] ?? 'Family-run British luxury wedding transport since 1990. Vintage Rolls Royces, Horse Drawn Carriages, and Rickshaws.' }}" />
  <meta name="twitter:image"       content="{{ $og['image']       ?? asset('images/hero.png') }}" />

  {{-- JSON-LD: LocalBusiness schema --}}
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "LocalBusiness",
    "@id": "{{ url('/') }}#business",
    "name": "A Star Limousine",
    "description": "Family-run British luxury wedding transport since 1990. Vintage Rolls Royces, Horse Drawn Carriages, and Rickshaws.",
    "url": "{{ url('/') }}",
    "logo": {
      "@type": "ImageObject",
      "url": "{{ asset('images/logo.png') }}"
    },
    "image": "{{ asset('images/hero.png') }}",
    "telephone": ["+447956392801", "+447890396875"],
    "email": "info@astarlimousine.co.uk",
    "foundingDate": "1990",
    "priceRange": "££",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "68 Weston Drive",
      "addressLocality": "Stanmore",
      "addressRegion": "Middlesex",
      "postalCode": "HA7 2ES",
      "addressCountry": "GB"
    },
    "geo": {
      "@type": "GeoCoordinates",
      "latitude": 51.6209,
      "longitude": -0.3122
    },
    "areaServed": [
      { "@type": "City", "name": "London" },
      { "@type": "AdministrativeArea", "name": "Middlesex" }
    ],
    "serviceType": ["Wedding Transport", "Luxury Car Hire", "Horse Drawn Carriage", "Rickshaw Hire"],
    "openingHoursSpecification": [
      {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],
        "opens": "09:00",
        "closes": "18:00"
      }
    ],
    "sameAs": [
      "https://wa.me/447956392801",
      "https://www.facebook.com/varsanirolls",
      "https://www.instagram.com/varsanirolls"
    ]
  }
  </script>

  {{-- Page-specific JSON-LD schemas pushed from child views --}}
  @stack('schema')

  <link rel="stylesheet" href="{{ asset('css/astar.css') }}?v={{ filemtime(public_path('css/astar.css')) }}" />
  @yield('extra_styles')
</head>
<body>

<header>
  <nav class="navbar">
    <div class="nav-inner">
      <a href="{{ route('home') }}" class="nav-logo">A STAR <span>LIMOUSINE</span></a>
      <div class="nav-links">
        <a href="{{ route('home') }}"    class="nav-link {{ request()->routeIs('home')    ? 'active' : '' }}">Home</a>
        <a href="{{ route('about') }}"   class="nav-link {{ request()->routeIs('about')   ? 'active' : '' }}">About Us</a>
        <a href="{{ route('fleet') }}"   class="nav-link {{ request()->routeIs('fleet*')  ? 'active' : '' }}">Our Fleet</a>
        <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
        <a href="https://wa.me/447956392801" target="_blank" rel="noopener" class="btn-whatsapp">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
          WhatsApp
        </a>
        <a href="{{ route('contact') }}" class="btn-book">Book Now</a>
      </div>
      <button class="nav-toggle" id="nav-toggle" aria-label="Menu">
        <svg id="icon-open"  width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="3" y1="6"  x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
        <svg id="icon-close" width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:none"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </button>
    </div>
    <div class="nav-mobile" id="nav-mobile">
      <a href="{{ route('home') }}"    class="nav-link">Home</a>
      <a href="{{ route('about') }}"   class="nav-link">About Us</a>
      <a href="{{ route('fleet') }}"   class="nav-link">Our Fleet</a>
      <a href="{{ route('contact') }}" class="nav-link">Contact</a>
      <a href="https://wa.me/447956392801" target="_blank" rel="noopener" class="btn-whatsapp">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
        Chat on WhatsApp
      </a>
      <a href="{{ route('contact') }}" class="btn-gold">Book Now</a>
    </div>
  </nav>
</header>

@yield('content')

<footer>
  <div class="container">
    <div class="footer-grid">
      <div>
        <a href="{{ route('home') }}" class="footer-logo">A STAR <span>LIMOUSINE</span></a>
        <p>A family-run British luxury transport business since 1990. We provide the perfect vehicle for the most important days of your life, from vintage Rolls Royces to Horse Drawn Carriages.</p>
        <p class="footer-tagline">"The Personal Touch"</p>
        <div class="footer-social">
          <a href="https://www.facebook.com/varsanirolls" target="_blank" rel="noopener" aria-label="Facebook">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
          </a>
          <a href="https://www.instagram.com/varsanirolls" target="_blank" rel="noopener" aria-label="Instagram">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
          </a>
        </div>
      </div>
      <div class="footer-col">
        <h4>Our Fleet</h4>
        <ul>
          <li><a href="{{ route('fleet.luxury-cars') }}">Luxury Cars</a></li>
          <li><a href="{{ route('fleet.horse-drawn-carriage') }}">Horse Drawn Carriage</a></li>
          <li><a href="{{ route('fleet.rickshaw') }}">Rickshaw (Tuk Tuk)</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Contact</h4>
        <ul>
          <li>
            <span class="contact-label-sm">Phone</span>
            <a href="tel:+447956392801">07956 39 28 01</a><br>
            <a href="tel:+447890396875">07890 39 68 75</a>
          </li>
          <li>
            <span class="contact-label-sm">Email</span>
            <a href="mailto:info@astarlimousine.co.uk">info@astarlimousine.co.uk</a>
          </li>
          <li>
            <span class="contact-label-sm">Address</span>
            <span>68 Weston Drive, Stanmore<br>Middlesex, HA7 2ES</span>
          </li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; {{ date('Y') }} A Star Limousine. All rights reserved. Est 1990.</p>
      <div class="footer-bottom-links">
        <a href="{{ route('privacy') }}">Privacy Policy</a>
        <a href="{{ route('terms') }}">Terms of Service</a>
      </div>
    </div>
  </div>
</footer>

<script src="{{ asset('js/astar.js') }}?v={{ filemtime(public_path('js/astar.js')) }}"></script>
</body>
</html>
