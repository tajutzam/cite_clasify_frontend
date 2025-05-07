<?php

namespace App\Http\Controllers;

use App\Models\JournalAnalysis;
use App\Models\ScopusReference;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $user = User::count();
        $journals = JournalAnalysis::count();


        $publicationData = ScopusReference::selectRaw('publication_year, COUNT(*) as count')
            ->groupBy('publication_year')
            ->get();
        $publicationData = $publicationData->map(function ($publication) {
            $publication->publication_year = Carbon::parse($publication->publication_year)->year;

            return $publication;
        });

        return view('dashboard.index', compact('user', 'journals', 'publicationData'));
    }
}
