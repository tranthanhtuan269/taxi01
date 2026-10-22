<?php

namespace App\Http\Controllers;

class HomeController extends SiteController
{
    public function index()
    {
        return view('site.home', $this->siteData());
    }
}
