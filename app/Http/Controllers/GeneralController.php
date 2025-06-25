<?php

namespace App\Http\Controllers;

class GeneralController
{
    public function index()
    {
        return view('dashboards.index', [
            "namepage" => "Home",
        ]);
    }
    
    public function live_monitoring()
    {

    }
}