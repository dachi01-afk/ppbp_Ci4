<?php

namespace App\Controllers\Apps;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    protected $module;
    protected $path;
    protected $title;

    function __construct()
    {
        $this->path = "Apps";
        $this->module = "Dashboard";
        $this->title = "Dashboard";
    }

    public function index()
    {
        $data['title'] = 'Data Admin';
        $data = [
            "title"     => $this->title,
            "path"      => $this->path,
            "module"    => $this->module,
            "act"       => "",
        ];
        return view($this->path . '/' . $this->module, $data);
    }
}
