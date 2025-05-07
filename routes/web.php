<?php

use App\Http\Controllers\AnalysisController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatasetController;
use App\Http\Controllers\HistoryUjiController;
use App\Http\Controllers\JournalAnalysisController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\UserController;
use App\Models\JournalAnalysis;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, "index"]);

Route::post("/signout", [AuthController::class, 'logout'])->name('auth.signout');
Route::get("/login", [AuthController::class, "login"])->name('login');

Route::get("/google/redirect", [AuthController::class, "handleLoginGoogle"])->name('login.google');
Route::get("/google/callback", [AuthController::class, "handleLoginGoogleCalback"])->name('login.google.calback');


Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(
    function () {
        Route::get('/', [DashboardController::class, "index"])->name('index');
        Route::get('/journal', [JournalAnalysisController::class, "index"])->name('journal.index');
        Route::post('/journal', [JournalAnalysisController::class, "analisa"])->name('journal.store');
        Route::get('/journal/{id}', [JournalAnalysisController::class, "show"])->name('journal.show');
        Route::delete('/journal/{id}', [JournalAnalysisController::class, "destroy"])->name('journal.destroy');

        Route::resource('/dataset', DatasetController::class);
        Route::get('/uji_model', [HistoryUjiController::class, "index"])->name('uji_model.index');
        Route::resource('/user', UserController::class);
        Route::get("analysis", [AnalysisController::class, "index"])->name('analysis.index');
    }
);

// api

Route::middleware('auth')->group(function () {
    Route::post("/save-result", [AnalysisController::class, "save"])->name('save.result');
    Route::get("/results", [AnalysisController::class, "getData"])->name('result.index');
    Route::delete("/results/{id}", [AnalysisController::class, "destroy"])->name('result.delete');
});
