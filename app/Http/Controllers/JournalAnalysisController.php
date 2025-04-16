<?php

namespace App\Http\Controllers;

use App\Models\CitationSentence;
use App\Models\JournalAnalysis;
use App\Models\ScopusReference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class JournalAnalysisController extends Controller
{
    public function index()
    {
        return view('dashboard.journal_analysis.index');
    }

    public function analisa(Request $request)
    {

        $request->validate([
            'file' => 'required|mimes:pdf|max:10240',
            'title' => 'nullable|string'
        ]);
        DB::beginTransaction();

        try {
            //code...
            $journalPdf = $request->file('file');
            $title = $request->input('title', "");

            $response = Http::attach(
                'file',
                file_get_contents($journalPdf),
                $journalPdf->getClientOriginalName()
            )->post(env('BACKEND_URL', 'http://localhost:5000') . "/upload-pdf", [
                'title' => $title,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $responseCollection = collect($data);
                $journal = JournalAnalysis::create(
                    [
                        'pdf' => $responseCollection->get('pdf'),
                        'user_id' => Auth::user()->id,
                        'title' => $responseCollection->get('title')
                    ]
                );

                if (isset($journal)) {
                    $citationSentences = $responseCollection->get('citation_sentences');
                    foreach ($citationSentences as $key => $citation) {
                        # code...
                        CitationSentence::create(
                            [
                                'journal_analysis_id' => $journal->id,
                                'accuracy' => $citation['accuracy'],
                                'text' => $citation['text'],
                                'label' => $citation['label']
                            ]
                        );
                    }

                    $scopus = $responseCollection->get('search_results');

                    if ($scopus[0]['Authors'] == 'No authors found' &&  $scopus[0]['Title'] == 'No title found') {
                    } else {
                        foreach ($scopus as $key => $scopusValue) {
                            # code...
                            ScopusReference::create(
                                [
                                    'authors' => $scopusValue['Authors'],
                                    'citations' => $scopusValue['Citations'],
                                    'doi' => $scopusValue['DOI'],
                                    'publication_name' => $scopusValue['Publication Name'],
                                    'publication_year' => $scopusValue['Publication Year'],
                                    'title' => $scopusValue['Title']
                                ]
                            );
                        }
                    }
                }
                DB::commit();
                return redirect()->back()->with('success', 'Jurnal berhasil dianalisis!');
            } else {
                return redirect()->back()->with('error', 'Gagal mengirim jurnal untuk dianalisis.');
            }
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }
}
