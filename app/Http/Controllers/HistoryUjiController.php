<?php

namespace App\Http\Controllers;

use App\Models\ClassificationReport;
use Illuminate\Http\Request;

class HistoryUjiController extends Controller
{
    //

    public function index()
    {
        $clasifications = ClassificationReport::get()->map(function ($item) {
            $item->confusion_matrix = env('BACKEND_URL', 'http://localhost:5000') . "/" . $item->confusion_matrix;
            $item->classification_report = collect(json_decode($item->classification_report, true));
            return $item;
        });
        return view('dashboard.history.index', compact('clasifications'));
    }
}
