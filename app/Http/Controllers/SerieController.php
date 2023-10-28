<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SerieController extends Controller
{
    public function __invoke()
    {
        return view("pages.search-serie");
    }
}