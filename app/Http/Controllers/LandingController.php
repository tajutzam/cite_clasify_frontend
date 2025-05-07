<?php

namespace App\Http\Controllers;

use App\Models\ScopusReference;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    //

    public function index()
    {
        $scopuses = ScopusReference::whereNotNull('sjr')
            ->orderBy('sjr', 'desc')
            ->get();
        return view('welcome', compact('scopuses'));
    }
}
