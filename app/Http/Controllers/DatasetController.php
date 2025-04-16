<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use Illuminate\Http\Request;

class DatasetController extends Controller
{
    //
    public function index()
    {
        $page = request()->get('page', 1);
        $perPage = request()->get('per_page', 10);

        $dataset = Dataset::paginate($perPage, $page);

        return view('dashboard.dataset.index', compact('dataset'));
    }
}
