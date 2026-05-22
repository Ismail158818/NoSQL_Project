<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    public function Show_Home(): View
    {
        return view('welcome');
    }
}
