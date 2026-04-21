<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        return view('home', [
            'og' => [
                'title'       => 'A Star Limousine — Luxury Wedding Transport Since 1990',
                'description' => 'Family-run British luxury wedding transport since 1990. Vintage Rolls Royces, Horse Drawn Carriages, and Rickshaws. Based in Stanmore, Middlesex.',
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
                'title'       => 'About Us — A Star Limousine',
                'description' => 'Learn about A Star Limousine, a family-run British luxury wedding transport business established in 1990 in Stanmore, Middlesex.',
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
                'title'       => 'Our Fleet — A Star Limousine',
                'description' => 'Explore our fleet of Luxury Cars, Horse Drawn Carriages, and Rickshaws for weddings and special events.',
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
                'title'       => 'Luxury Cars — A Star Limousine',
                'description' => 'Vintage Rolls Royces, Bentley Flying Spur, Rolls Royce Phantom and more. Our luxury car fleet for weddings in London and Middlesex.',
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
                'title'       => 'Horse Drawn Carriage — A Star Limousine',
                'description' => 'Arrive at your wedding like Cinderella in a beautifully decorated horse-drawn carriage. A truly fairy tale arrival.',
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
                'title'       => 'Rickshaw / Tuk Tuk — A Star Limousine',
                'description' => 'A unique and show-stopping way to arrive at your wedding. Our beautifully decorated rickshaw is unlike anything else.',
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
                'title'       => 'Contact — A Star Limousine',
                'description' => 'Contact A Star Limousine to enquire about our luxury wedding transport. Call, email, or send us a message.',
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
            ['url' => url('/'),                           'priority' => '1.0', 'changefreq' => 'weekly'],
            ['url' => url('/about'),                      'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => url('/fleet'),                      'priority' => '0.9', 'changefreq' => 'monthly'],
            ['url' => url('/fleet/luxury-cars'),          'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => url('/fleet/horse-drawn-carriage'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => url('/fleet/rickshaw'),             'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => url('/contact'),                    'priority' => '0.7', 'changefreq' => 'monthly'],
            ['url' => url('/privacy'),                    'priority' => '0.3', 'changefreq' => 'yearly'],
            ['url' => url('/terms'),                      'priority' => '0.3', 'changefreq' => 'yearly'],
        ];

        return response()
            ->view('sitemap', compact('pages'))
            ->header('Content-Type', 'application/xml');
    }
}
