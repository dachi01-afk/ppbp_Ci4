<?php

namespace App\Controllers;

class MemberPage extends BaseController
{
    public function index()

    {

        return view('PageMember/Home');
    }

    public function AddMember()

    {

        return view('PageMember/AddMember');
    }

    public function PengmumumanMember()

    {

        return view('PageMember/Pengumuman');
    }
}
