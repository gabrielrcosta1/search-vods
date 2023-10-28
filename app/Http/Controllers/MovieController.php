<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function __invoke()
    {
        return view('pages.search-movie');
    }
}