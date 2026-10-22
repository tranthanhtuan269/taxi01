<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends SiteController
{
    public function pricing()
    {
        return view('site.pricing', $this->siteData());
    }

    public function airport()
    {
        return view('site.airport', $this->siteData());
    }

    public function tours()
    {
        return view('site.tours', $this->siteData());
    }

    public function fleet()
    {
        return view('site.fleet', $this->siteData());
    }

    public function offers()
    {
        return view('site.offers', $this->siteData());
    }

    public function booking()
    {
        return view('site.booking', $this->siteData());
    }

    public function show(string $slug)
    {
        $page = Page::active()->where('slug', $slug)->firstOrFail();

        return view('site.page', $this->siteData(['page' => $page]));
    }
}
