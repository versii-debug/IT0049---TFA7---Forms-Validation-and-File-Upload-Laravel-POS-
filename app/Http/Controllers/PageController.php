<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function landing()
    {
        return view('pages.landing', ['title' => 'Dashboard']);
    }

    public function about()
    {
        return view('pages.about', ['title' => 'About']);
    }
}
