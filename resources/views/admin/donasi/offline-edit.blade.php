@extends('admin.components.app')

@section('content')
    <div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">

        <h2 class="text-xl font-bold mb-4">Edit donasiOffline Offline</h2>

        <form method="POST" action="{{ route('admin.donasi.offline.update', $donasiOffline->id) }}"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-semibold">Program Campaign</label>
                <select name="program_id" class="border w-full p-2 rounded">
                    @foreach ($programs as $p)
                        <option value="{{ $p->id }}" {{ $donasiOffline->program_id == $p->id ? 'selected' : '' }}>
                            {{ $p->judul }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Nama Donatur</label>
                <input type="text" class="border w-full p-2 rounded" value="{{ $donasiOffline->nama_donatur }}"
                    name="nama">
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Telepon</label>
                <input type="text" class="border w-full p-2 rounded" value="{{ $donasiOffline->telepon }}"
                    name="telepon">
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Email</label>
                <input type="email" class="border w-full p-2 rounded" value="{{ $donasiOffline->email }}" name="email">
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Nominal</label>
                <input type="number" class="border w-full p-2 rounded" value="{{ $donasiOffline->nominal }}"
                    name="nominal">
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Tanggal Transaksi</label>
                <input type="date" class="border w-full p-2 rounded" value="{{ $donasiOffline->tanggal_transaksi }}"
                    name="tanggal_transaksi">
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Ganti Foto Bukti (opsional)</label>
                <input type="file" name="bukti_foto" class="border p-2 rounded">

                @if ($donasiOffline->bukti_foto)
                    <img src="{{ asset('storage/' . $donasiOffline->bukti_foto) }}" class="h-32 border rounded mt-2">
                @endif
            </div>

            <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Update donasiOffline
            </button>

        </form>
    </div>
@endsection
