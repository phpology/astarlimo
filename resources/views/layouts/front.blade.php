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
    "name": "A Star Limousine",
    "description": "Family-run British luxury wedding transport since 1990. Vintage Rolls Royces, Horse Drawn Carriages, and Rickshaws.",
    "url": "{{ url('/') }}",
    "logo": "{{ asset('images/logo.png') }}",
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
    "areaServed": [
      { "@type": "City", "name": "London" },
      { "@type": "AdministrativeArea", "name": "Middlesex" }
    ],
    "serviceType": ["Wedding Transport", "Luxury Car Hire", "Horse Drawn Carriage", "Rickshaw Hire"],
    "sameAs": [
      "https://wa.me/447956392801"
    ]
  }
  </script>

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
            <a href="tel:07956392801">07956 39 28 01</a><br>
            <a href="tel:07890396875">07890 39 68 75</a>
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
