<?php

namespace App\Controllers;

class LandingPage extends BaseController
{
    public function index()
    {
        return view('Layout/Home');
    }

    public function Panduan()
    {
        return view('Layout/Panduan');
    }

    public function Galeri()
    {
        return view('Layout/Galeri');
    }
}
