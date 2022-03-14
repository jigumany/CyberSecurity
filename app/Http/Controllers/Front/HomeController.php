<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Display the home view.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Front/Home');
    }
}
