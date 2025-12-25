@extends('admin.components.app')

@section('content')
    <div class="max-w-6xl mx-auto p-6 bg-white shadow rounded">

        <h2 class="text-2xl font-bold mb-6">Donasi Offline</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.donasi.offline.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-2 gap-6">

                {{-- Left Column --}}
                <div class="space-y-4">
                    <div>
                        <label class="block font-semibold">Program Campaign</label>
                        <select name="program_id" class="w-full border px-3 py-2 rounded form-control">
                            @foreach ($programs as $prog)
                                <option value="{{ $prog->id }}">{{ $prog->judul }}</option>
                            @endforeach
                        </select>


                    </div>

                    <div>
                        <label class="block font-semibold">Akad Khusus</label>
                        <input type="text" name="akad" placeholder="Pilih Akad Khusus"
                            class="w-full border px-3 py-2 rounded">
                    </div>

                    <div>
                        <label class="block font-semibold">Konten</label>
                        <select name="konten" class="w-full border px-3 py-2 rounded">
                            @foreach ($contents as $c)
                                <option value="{{ $c }}">{{ $c }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold">Kanal</label>
                        <select name="kanal" class="w-full border px-3 py-2 rounded">
                            @foreach ($channels as $ch)
                                <option value="{{ $ch }}">{{ $ch }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold">Upload Bukti / Foto Donasi</label>
                        <input type="file" name="bukti_foto" accept="image/jpeg,image/png"
                            class="w-full border px-3 py-2 rounded bg-white cursor-pointer">
                    </div>

                </div>

                {{-- Right Column --}}
                <div class="space-y-4">
                    <div>
                        <label class="block font-semibold">Nama</label>
                        <input type="text" name="nama" placeholder="Masukkan Nama Lengkap"
                            class="w-full border px-3 py-2 rounded">
                    </div>

                    <div>
                        <label class="block font-semibold">Nomor Telepon</label>
                        <div class="flex gap-2">
                            <span class="inline-flex items-center px-3 bg-gray-200 rounded-l">+62</span>
                            <input type="text" name="telepon" placeholder="Contoh: 0812-345-678"
                                class="w-full border px-3 py-2 rounded-r">
                        </div>
                    </div>

                    <div>
                        <label class="block font-semibold">Email</label>
                        <input type="email" name="email" placeholder="Masukkan Email"
                            class="w-full border px-3 py-2 rounded">
                    </div>

                    <div>
                        <label class="block font-semibold">Nominal</label>
                        <input type="number" name="nominal" placeholder="Masukkan Nominal"
                            class="w-full border px-3 py-2 rounded">
                    </div>

                    <div>
                        <label class="block font-semibold">Metode Pembayaran</label>
                        <select name="metode" class="w-full border px-3 py-2 rounded">
                            <option value="cash">Cash</option>
                        </select>
                    </div>

                    <div class="flex items-center gap-4 mt-2">
                        <div class="mt-4">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" id="autoTanggal" checked>
                                <span class="font-semibold">Gunakan tanggal otomatis (hari ini)</span>
                            </label>
                        </div>

                        <div class="mt-2">
                            <label class="block font-semibold">Tanggal Transaksi</label>
                            <input type="date" name="tanggal_transaksi" id="tanggalInput" value="{{ date('Y-m-d') }}"
                                class="w-full border px-3 py-2 rounded">
                        </div>

                        <script>
                            const checkbox = document.getElementById("autoTanggal");
                            const tanggalInput = document.getElementById("tanggalInput");

                            checkbox.addEventListener("change", function() {
                                if (checkbox.checked) {
                                    tanggalInput.value = new Date().toISOString().substr(0, 10);
                                    tanggalInput.readOnly = true; // tidak bisa diketik
                                } else {
                                    tanggalInput.readOnly = false;
                                }
                            });
                            // default
                            tanggalInput.readOnly = true;
                        </script>

                        <div>
                            <input type="checkbox" name="notifikasi[]" value="email">
                            <label>Kirim Notifikasi Email</label>
                        </div>
                        <div>
                            <input type="checkbox" name="notifikasi[]" value="whatsapp">
                            <label>Kirim Notifikasi WhatsApp</label>
                        </div>
                    </div>

                    <button type="submit" class="mt-4 bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                        Submit
                    </button>
                </div>

            </div>
        </form>

    </div>
@endsection
