<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;

class ProgramSearchController extends Controller
{
    public function search(Request $request)
    {
        $q = $request->q;

        $results = Program::where('judul', 'like', "%$q%")
            ->orWhere('kategori', 'like', "%$q%")
            ->orWhere('deskripsi', 'like', "%$q%")
            ->get();

        return view('search.result', compact('results', 'q'));
    }

    public function detail($kategori, $slug)
{
    $program = Program::where('kategori', $kategori)
        ->where('slug', $slug)
        ->firstOrFail();

    // Sesuaikan path view dengan struktur foldermu
    return view('program.donasi.index', compact('program'));
}


}