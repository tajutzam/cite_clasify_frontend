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
        $user = Auth::user();
        $title = request()->query('title');

        $query = JournalAnalysis::with(['citation_sentences', 'scopus_references', 'user'])->orderByDesc('created_at');



        if ($user->role !== 'admin') {
            $query->where('user_id', $user->id);
        }

        if (!empty($title)) {
            $query->where('title', 'like', '%' . $title . '%');
        }

        $data = $query->get();

        return view('dashboard.journal_analysis.index', compact('data'));
    }


    public function destroy($journal)
    {
        $journal = JournalAnalysis::findOrFail($journal);
        $journal->delete();
        return redirect()->route('dashboard.journal.index')->with('success', 'berhasil menghapus journal ');
    }

    public function show($id)
    {
        $journal = JournalAnalysis::with(['citation_sentences', 'scopus_references'])->find($id);

        if ($journal) {
            $citationSentences = $journal->citation_sentences()->paginate(10);
            return view('dashboard.journal_analysis.show', compact('journal', 'citationSentences'));
        }
        return redirect()->back()->with('error', 'Data journal tidak ditermuakn');
    }



    public function analisa(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:10240',
            'title' => 'nullable|string'
        ]);

        DB::beginTransaction();
        try {
            $journalPdf = $request->file('file');
            $title = $request->input('title', "");

            $response = Http::attach(
                'file',
                file_get_contents($journalPdf),
                $journalPdf->getClientOriginalName()
            )->post(env('BACKEND_URL', 'http://localhost:5000') . "/upload-pdf", [
                'title' => $title,
            ]);

            if (!$response->successful()) {
                return response()->json(['error' => 'Gagal mengirim jurnal untuk dianalisis.'], 500);
            }

            $data = $response->json();
            $responseCollection = collect($data);

            $journal = JournalAnalysis::create([
                'pdf' => $responseCollection->get('pdf'),
                'user_id' => Auth::id(),
                'title' => $responseCollection->get('title')
            ]);

            $citationSentences = $responseCollection->get('citation_sentences');
            foreach ($citationSentences as $citation) {
                $trimmedText = trim($citation['text']);

                $existingCitation = CitationSentence::where('text', $trimmedText)
                    ->where('journal_analysis_id', $journal->id)
                    ->first();

                if (!$existingCitation) {
                    CitationSentence::create([
                        'journal_analysis_id' => $journal->id,
                        'accuracy' => $citation['accuracy'],
                        'text' => $trimmedText,
                        'label' => $citation['label']
                    ]);
                }
            }

            $scopus = $responseCollection->get('search_results');
            if ($scopus && $scopus[0]['Authors'] != 'No authors found' && $scopus[0]['Title'] != 'No title found') {
                foreach ($scopus as $scopusValue) {
                    ScopusReference::create([
                        "journal_analysis_id" => $journal->id,
                        'authors' => $scopusValue['Authors'],
                        'citations' => $scopusValue['Citations'],
                        'doi' => $scopusValue['DOI'],
                        'publication_name' => $scopusValue['Publication Name'],
                        'publication_year' => $scopusValue['Publication Year'],
                        'title' => $scopusValue['Title'],
                        'issn' => $scopusValue['ISSN'],
                        'sjr' => $scopusValue['SJR'],
                        'snip' => $scopusValue['SNIP']
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'message' => 'Jurnal berhasil dianalisis.',
                'journal_id' => $journal->id,
                'citation_count' => count($citationSentences),
                'scopus_reference_count' => count($scopus),
            ], 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
