@extends('admin.components.app')

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">

        <h2 class="text-2xl font-bold mb-6">
            Detail Donasi Offline
        </h2>

        <table class="table-auto w-full text-left border">
            <tr>
                <th class="p-2 border">Nama Donatur</th>
                <td class="p-2 border">{{ $donasiOffline->nama_donatur }}</td>
            </tr>

            <tr>
                <th class="p-2 border">Program</th>
                <td class="p-2 border">
                    {{ $donasiOffline->program->judul ?? '-' }}
                </td>
            </tr>

            <tr>
                <th class="p-2 border">Nominal</th>
                <td class="p-2 border">
                    Rp {{ number_format($donasiOffline->nominal, 0, ',', '.') }}
                </td>
            </tr>

            <tr>
                <th class="p-2 border">Metode</th>
                <td class="p-2 border">{{ $donasiOffline->metode }}</td>
            </tr>

            <tr>
                <th class="p-2 border">Tanggal Transaksi</th>
                <td class="p-2 border">{{ $donasiOffline->tanggal_transaksi ?? '-' }}</td>
            </tr>

            <tr>
                <th class="p-2 border">Bukti Foto</th>
                <td class="p-2 border">
                    @if ($donasiOffline->bukti_foto)
                        <img src="{{ asset('storage/' . $donasiOffline->bukti_foto) }}" class="h-40 rounded">
                    @else
                        Tidak ada
                    @endif
                </td>
            </tr>

        </table>

        <a href="{{ route('admin.donasi.offline.index') }}"
            class="block w-fit mt-4 bg-gray-600 text-white px-4 py-2 rounded">
            Kembali
        </a>

    </div>
@endsection
