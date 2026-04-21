@extends('layouts.front')

@section('title', 'Our Fleet — A Star Limousine')
@section('description', 'Explore our fleet of Luxury Cars, Horse Drawn Carriages, and Rickshaws for weddings and special events.')

@section('content')

<div class="page-wrap">

  <section class="section">
    <div class="container">
      <div class="page-intro reveal">
        <p class="eyebrow">Est. 1990</p>
        <h1>Our Fleet</h1>
        <div class="divider" style="margin:1.25rem auto 1rem"></div>
        <p>Our fully trained staff are always happy to advise you on the best vehicle to suit your needs, taking into account both practicality and the nature of your event.</p>
      </div>
    </div>
  </section>

  <!-- Fleet Panels -->
  <div class="fleet-panel reveal">
    <div class="fleet-panel-img">
      <img src="{{ asset('images/luxury-hero.png') }}" alt="Luxury Wedding Cars" />
      <div class="fleet-panel-img-overlay"></div>
    </div>
    <div class="fleet-panel-body">
      <div class="fleet-panel-body-inner">
        <p class="eyebrow">From Vintage to Modern Prestige</p>
        <h2>Luxury Cars</h2>
        <p>Classic Rolls Royces, Bentleys, and Phantoms — a curated fleet of the world's finest automobiles to make your arrival truly unforgettable.</p>
        <a href="{{ route('fleet.luxury-cars') }}" class="btn btn-outline">View Collection &rarr;</a>
      </div>
    </div>
  </div>

  <div class="fleet-panel reverse reveal">
    <div class="fleet-panel-img">
      <img src="{{ asset('images/horse-carriage-hero.png') }}" alt="Horse Drawn Wedding Carriage" />
      <div class="fleet-panel-img-overlay"></div>
    </div>
    <div class="fleet-panel-body">
      <div class="fleet-panel-body-inner">
        <p class="eyebrow">A Truly Fairy Tale Arrival</p>
        <h2>Horse Drawn Carriage</h2>
        <p>Like Cinderella and her Prince Charming, you too could travel in truly classic style and have your fairy tale wedding come to life.</p>
        <a href="{{ route('fleet.horse-drawn-carriage') }}" class="btn btn-outline">View Collection &rarr;</a>
      </div>
    </div>
  </div>

  <div class="fleet-panel reveal">
    <div class="fleet-panel-img">
      <img src="{{ asset('images/rickshaw-hero.png') }}" alt="Wedding Rickshaw" />
      <div class="fleet-panel-img-overlay"></div>
    </div>
    <div class="fleet-panel-body">
      <div class="fleet-panel-body-inner">
        <p class="eyebrow">Travel In Style — Uniquely</p>
        <h2>Rickshaw</h2>
        <p>A show-stopping, wonderfully unique way to arrive at your celebration. Beautifully decorated and impossible to forget.</p>
        <a href="{{ route('fleet.rickshaw') }}" class="btn btn-outline">View Collection &rarr;</a>
      </div>
    </div>
  </div>

  <!-- Fleet CTA -->
  <div class="fleet-cta section-card">
    <div class="container">
      <div class="reveal" style="max-width:38rem;margin:0 auto;text-align:center">
        <h2>Not Sure Which Vehicle Is Right?</h2>
        <p>Our team is always happy to advise — whether you have your heart set on something or need a little guidance. We can also arrange champagne, chocolates, or flowers for collection.</p>
        <a href="{{ route('contact') }}" class="btn btn-gold" style="margin-top:2rem">Get In Touch</a>
      </div>
    </div>
  </div>

</div>

@endsection
