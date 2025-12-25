<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DonasiOffline;
use App\Models\Program;

class OfflineDonasiController extends Controller
{
    public function index()
    {
        $donasiOffline = DonasiOffline::with('program')
        ->where('metode','cash')
        ->latest()
        ->paginate(10);
    

        return view('admin.donasi.offline-list', compact('donasiOffline'));
    }

    public function create()
    {
        // sementara hardcode
        $programs = Program::all();
        $contents = ['#Wakaf Quran Santri', '#Shodaqah Sumatra'];
        $channels = ['Kanal 1', 'Kanal 2', 'Kanal 3'];

        return view('admin.donasi.offline', compact(
            'programs','contents','channels'
        ));
    }

    // Submit (Donasi Online)
    public function store(Request $request)
    {
        $request->validate([
            "program_id" => "required|integer",
            "nama" => "required",
            "email" => "nullable|email",
            "telepon" => "required",
            "nominal" => "required|numeric",
            "metode" => "required",
            "tanggal_transaksi" => "nullable|date",
            "bukti_foto" => "nullable|image|mimes:jpg,jpeg,png|max:2048",
        ]);

        $pathFoto = null;
        if ($request->hasFile('bukti_foto')) {
            $pathFoto = $request->file('bukti_foto')
            ->store('donasi/offline', 'public');
        }

        DonasiOffline::create([
            'program_id' => $request->program_id,
            'nama_donatur' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'nominal' => $request->nominal,
            'metode' => 'cash',
            'status' => 'paid',
            'tanggal_transaksi' => $request->tanggal_transaksi ?? now(),
            'bukti_foto' => $pathFoto,
        ]);

        return redirect()
            ->route('admin.donasi.offline.index')
            ->with('success','Donasi offline berhasil ditambahkan');
    }


    public function destroy($id)
    {
        DonasiOffline::findOrFail($id)->delete();

        return back()->with("success","Donasi berhasil dihapus");
    }

    public function show($id)
    {
        $donasiOffline = DonasiOffline::with('program')->findOrFail($id);
        return view('admin.donasi.offline-show', compact('donasiOffline'));
    }

    public function edit($id)
    {
        $donasiOffline = DonasiOffline::findOrFail($id);
        $programs = Program::all();

        return view('admin.donasi.offline-edit', compact('donasiOffline','programs'));
    }

    public function update(Request $request, $id)
    {
        $donasiOffline = DonasiOffline::findOrFail($id);

        $request->validate([
            "program_id" => "required|integer",
            "nama" => "required",
            "email" => "nullable|email",
            "telepon" => "required",
            "nominal" => "required|numeric",
            "tanggal_transaksi" => "nullable|date",
            "bukti_foto" => "nullable|image|mimes:jpg,jpeg,png|max:2048",
        ]);

        $data = [
            'program_id' => $request->program_id,
            'nama_donatur' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'nominal' => $request->nominal,
            'tanggal_transaksi' => $request->tanggal_transaksi,
        ];

        if ($request->hasFile('bukti_foto')) {
            $data['bukti_foto'] = $request->file('bukti_foto')
            ->store('donasi/offline', 'public');
        }

        $donasiOffline->update($data);

        return redirect()
            ->route('admin.donasi.offline.index')
            ->with('success','Donasi offline berhasil diperbarui');
    }
}
