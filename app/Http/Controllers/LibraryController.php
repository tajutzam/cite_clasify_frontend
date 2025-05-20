<?php

namespace App\Http\Controllers;

use App\Models\Library;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LibraryController extends Controller
{
    //


    public function index()
    {
        $librarys = Library::where('user_id', Auth::id())->paginate(10);
        return view('dashboard.library.index', compact('librarys'));
    }

    public function destroy($id)
    {

        $library = Library::findOrFail($id);
        $library->delete();
        return redirect()->back()->with('success', 'berhasil menghapus referensi');
    }

}
