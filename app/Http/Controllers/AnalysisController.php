<?php

namespace App\Http\Controllers;

use App\Models\AnalysisResult;
use App\Models\Library;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AnalysisController extends Controller
{
    //
    public function index()
    {
        $analisis = AnalysisResult::all();
        return view("dashboard.analisis.index");
    }


    public function getData()
    {
        $user = Auth::user();
        $results = [];
        if ($user->role == 'admin') {
            $results = AnalysisResult::with('user')->get();
        } else {
            $results = AnalysisResult::where('user_id', $user->id)->get();
        }
        return response()->json(
            [
                'data' => $results
            ]
        );
    }



    public function save(Request $request)
    {

        $userId = Auth::user()->id;

        AnalysisResult::create(
            [
                'user_id' => $userId,
                'text' => $request->text,
                'accuracy' => $request->accuracy,
                'prediction' => $request->prediction
            ]
        );

        return response()->json(
            [
                'message' => 'Hasil analisis berhasil disimpan.',
                'status' => 'success',
                'data' => [
                    'user_id' => $userId,
                    'text' => $request->text,
                    'accuracy' => $request->accuracy,
                    'prediction' => $request->prediction
                ]
            ]
        );
    }


    public function destroy(Request $request, $id)
    {
        AnalysisResult::where('id', $id)->delete();
        return response()->json(
            [
                'success' => true,
                'message' => 'berhasil menghapus data riwayat klasifikasi'
            ]
        );

    }


    public function searchScopus(Request $request)
    {
        $results = collect();
        $totalResults = 0;
        $perPage = 10;
        $currentPage = $request->get('page', 1);
        $keyword = $request->get('keyword');

        if ($keyword) {
            $token = config('services.scopus.token');
            $startIndex = ($currentPage - 1) * $perPage;

            // Query gabungkan keyword dan bahasa Indonesia
            $query = "KEY($keyword)+AND+language(indonesian)";


            // Tambahkan sorting dari tahun terbaru (coverDate descending)
            $url = "https://api.elsevier.com/content/search/scopus?query={$query}&apiKey={$token}&start={$startIndex}&count={$perPage}&sort=-coverDate";

            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'X-ELS-APIKey' => $token,
            ])->get($url);

            if ($response->successful()) {
                $data = $response->json();
                $entries = $data['search-results']['entry'] ?? [];
                $totalResults = (int) ($data['search-results']['opensearch:totalResults'] ?? 0);

                $results = new LengthAwarePaginator(
                    $entries,
                    $totalResults,
                    $perPage,
                    $currentPage,
                    ['path' => route('dashboard.scopus.search'), 'query' => ['keyword' => $keyword]]
                );
            }
        }

        return view('dashboard.scopus.index', compact('results', 'keyword'));
    }


    public function store(Request $request)
    {
        $doi = $request->input('doi');

        if ($doi && Library::where('doi', $doi)->exists()) {
            return back()->with('error', 'Artikel dengan DOI tersebut sudah ada di library.');
        }

        $data = $request->only([
            'title',
            'creator',
            'journal',
            'volume',
            'issue',
            'date',
            'doi',
            'citedby',
            'affiliation_name',
            'affiliation_city',
            'affiliation_country',
            'scopus_link',
        ]);

        $data['user_id'] = Auth::id();

        Library::create($data);

        return back()->with('success', 'Artikel berhasil ditambahkan ke Library!');
    }

}
