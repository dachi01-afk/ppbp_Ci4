<?php

namespace App\Controllers;

class LandingPage extends BaseController
{

    public function Login()
    {
        return view('Auth/Login');
    }

    public function Register()
    {
        return view('Auth/Register');
    }

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

    public function CekLogin() {}
}
