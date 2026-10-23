<?php

namespace App\Http\Controllers;

use App\Models\Commitment;
use App\Models\Destination;
use App\Models\Faq;
use App\Models\FareRoute;
use App\Models\Promotion;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Vehicle;

abstract class SiteController extends Controller
{
    protected function siteData(array $extra = []): array
    {
        return array_merge([
            'vehicles' => Vehicle::with('prices')->active()->orderBy('sort_order')->orderBy('id')->get(),
            'services' => Service::active()->orderBy('sort_order')->orderBy('id')->get(),
            'routes' => FareRoute::with('prices')->active()->orderBy('sort_order')->orderBy('id')->get(),
            'testimonials' => Testimonial::active()->orderBy('sort_order')->orderBy('id')->get(),
            'faqs' => Faq::active()->orderBy('sort_order')->orderBy('id')->get(),
            'commitments' => Commitment::active()->orderBy('sort_order')->orderBy('id')->get(),
            'promotions' => Promotion::active()->orderBy('sort_order')->orderBy('id')->get(),
            'destinations' => Destination::active()->orderBy('sort_order')->orderBy('id')->get(),
        ], $extra);
    }
}
