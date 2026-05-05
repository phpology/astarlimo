<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        return view('home', [
            'og' => [
                'title'       => 'Wedding Car Hire London | A Star Limousine',
                'description' => 'Luxury wedding car hire across London and Middlesex. Rolls Royces, horse drawn carriages and rickshaws. Family-run since 1990. Contact us for a quote.',
                'image'       => asset('images/hero.png'),
                'url'         => url('/'),
                'type'        => 'website',
            ],
        ]);
    }

    public function about()
    {
        return view('about', [
            'og' => [
                'title'       => 'About A Star Limousine | Family Wedding Transport Since 1990',
                'description' => 'A Star Limousine has provided luxury wedding car hire in London and Middlesex since 1990. A family-run business built on personal service and trust.',
                'image'       => asset('images/about.png'),
                'url'         => url('/about'),
                'type'        => 'website',
            ],
        ]);
    }

    public function fleet()
    {
        return view('fleet.index', [
            'og' => [
                'title'       => 'Wedding Transport Fleet | Luxury Cars, Carriages & Rickshaws',
                'description' => 'Explore our wedding transport fleet — luxury cars, horse drawn carriages and rickshaws, available for hire across London and Middlesex. Enquire today.',
                'image'       => asset('images/luxury-hero.png'),
                'url'         => url('/fleet'),
                'type'        => 'website',
            ],
        ]);
    }

    public function fleetLuxuryCars()
    {
        return view('fleet.luxury-cars', [
            'og' => [
                'title'       => 'Luxury Wedding Car Hire London | Rolls Royce & Bentley',
                'description' => 'Hire a Vintage Rolls Royce, Bentley or Phantom for your wedding. Luxury wedding car hire across London and Middlesex. Call us to check availability.',
                'image'       => asset('images/luxury-hero.png'),
                'url'         => url('/fleet/luxury-cars'),
                'type'        => 'website',
            ],
        ]);
    }

    public function fleetHorseCarriage()
    {
        return view('fleet.horse-drawn-carriage', [
            'og' => [
                'title'       => 'Horse Drawn Carriage Hire for Weddings | London & Middlesex',
                'description' => 'Horse drawn carriage hire for weddings in London and Middlesex. Arrive in fairy tale style — beautifully decorated and truly unforgettable. Get in touch.',
                'image'       => asset('images/horse-carriage-hero.png'),
                'url'         => url('/fleet/horse-drawn-carriage'),
                'type'        => 'website',
            ],
        ]);
    }

    public function fleetRickshaw()
    {
        return view('fleet.rickshaw', [
            'og' => [
                'title'       => 'Wedding Rickshaw & Tuk Tuk Hire London | A Star Limousine',
                'description' => 'Wedding rickshaw and tuk tuk hire in London and Middlesex. Perfect for Asian weddings — a beautiful, show-stopping entrance your guests will never forget.',
                'image'       => asset('images/rickshaw-hero.png'),
                'url'         => url('/fleet/rickshaw'),
                'type'        => 'website',
            ],
        ]);
    }

    public function contact()
    {
        return view('contact', [
            'og' => [
                'title'       => 'Book Wedding Transport | Contact A Star Limousine',
                'description' => 'Get in touch to book your wedding transport. Call, WhatsApp or email A Star Limousine — trusted luxury wedding car hire in London and Middlesex since 1990.',
                'image'       => asset('images/luxury-1.png'),
                'url'         => url('/contact'),
                'type'        => 'website',
            ],
        ]);
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:50',
            'email'   => 'required|email|max:255',
            'vehicle' => 'required|in:luxury-car,horse-drawn-carriage,rickshaw',
            'date'    => 'required|date',
            'message' => 'required|string|min:5|max:2000',
        ]);

        // TODO: Send enquiry email to info@astarlimousine.co.uk
        // Mail::to('info@astarlimousine.co.uk')->send(new EnquiryMail($request->validated()));

        return response()->json(['success' => true]);
    }

    public function privacy()
    {
        return view('privacy', [
            'og' => [
                'title'       => 'Privacy Policy — A Star Limousine',
                'description' => 'Privacy Policy for A Star Limousine luxury wedding transport. How we handle your personal data.',
                'image'       => asset('images/hero.png'),
                'url'         => url('/privacy'),
                'type'        => 'website',
            ],
        ]);
    }

    public function terms()
    {
        return view('terms', [
            'og' => [
                'title'       => 'Terms of Service — A Star Limousine',
                'description' => 'Terms of Service for A Star Limousine luxury wedding transport.',
                'image'       => asset('images/hero.png'),
                'url'         => url('/terms'),
                'type'        => 'website',
            ],
        ]);
    }

    public function sitemap()
    {
        $pages = [
            ['url' => url('/'),                           'lastmod' => '2026-04-25', 'priority' => '1.0', 'changefreq' => 'weekly'],
            ['url' => url('/about'),                      'lastmod' => '2026-04-25', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => url('/fleet'),                      'lastmod' => '2026-04-25', 'priority' => '0.9', 'changefreq' => 'monthly'],
            ['url' => url('/fleet/luxury-cars'),          'lastmod' => '2026-04-25', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => url('/fleet/horse-drawn-carriage'), 'lastmod' => '2026-04-25', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => url('/fleet/rickshaw'),             'lastmod' => '2026-04-25', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => url('/contact'),                    'lastmod' => '2026-04-25', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['url' => url('/privacy'),                    'lastmod' => '2026-04-25', 'priority' => '0.3', 'changefreq' => 'yearly'],
            ['url' => url('/terms'),                      'lastmod' => '2026-04-25', 'priority' => '0.3', 'changefreq' => 'yearly'],
        ];

        return response()
            ->view('sitemap', compact('pages'))
            ->header('Content-Type', 'application/xml');
    }
}
