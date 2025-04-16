<?php

namespace App\Http\Controllers;

use App\Models\AnalysisResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
