@extends('layouts.app')

@section('title', 'Kalkulator Zakat')

@section('content')
    <div class="bg-green-50 py-20 relative overflow-hidden">
        <div class="container mx-auto px-6 md:px-12">
            <h1 class="text-3xl font-bold text-gray-800 ml-10">Kalkulator Zakat</h1>
        </div>
    </div>
    <div class="bg-gray-50 py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-12">
                    {{-- Left: jenis --}}
                    <aside class="lg:col-span-4 border-r p-6">
                        <h3 class="font-semibold text-lg mb-6">Pilih Jenis Zakat Anda</h3>

                        <div id="types" class="space-y-4">
                            <button data-type="penghasilan"
                                class="type-btn flex items-center gap-4 w-full p-4 rounded-lg bg-emerald-50 border">
                                <div class="w-14 h-14 flex items-center justify-center bg-white rounded-md shadow-sm">
                                    <!-- SVG icon (simple) -->
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none"
                                        class="text-green-600">
                                        <path d="M4 21h16" stroke="currentColor" stroke-width="1.6"
                                            stroke-linecap="round" />
                                        <path d="M6 7h12v10H6z" stroke="currentColor" stroke-width="1.6"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="text-left">
                                    <div class="font-semibold text-base">Penghasilan</div>
                                    <div class="font-light text-sm">Zakat penghasilan /
                                        profesi</div>
                                </div>
                            </button>

                            <button data-type="tabungan"
                                class="type-btn flex items-center gap-4 w-full p-4 rounded-lg bg-emerald-50 border">
                                <div class="w-14 h-14 flex items-center justify-center bg-white rounded-md shadow-sm">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                                        <path d="M3 7h18" stroke="#059669" stroke-width="1.6" />
                                        <path d="M4 11h16v7H4z" stroke="#059669" stroke-width="1.6" />
                                    </svg>
                                </div>
                                <div class="text-left">
                                    <div class="font-semibold text-base">Tabungan</div>
                                    <div class="font-light text-sm">Saldo & bunga bank</div>
                                </div>
                            </button>

                            <button data-type="perdagangan"
                                class="type-btn flex items-center gap-4 w-full p-4 rounded-lg bg-emerald-50 border">
                                <div class="w-14 h-14 flex items-center justify-center bg-white rounded-md shadow-sm">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                                        <path d="M3 7h18" stroke="#059669" stroke-width="1.6" />
                                        <path d="M7 11h10v6H7z" stroke="#059669" stroke-width="1.6" />
                                    </svg>
                                </div>
                                <div class="text-left">
                                    <div class="font-semibold text-base">Perdagangan</div>
                                    <div class="font-light text-sm">Usaha / dagang</div>
                                </div>
                            </button>

                            <button data-type="emas"
                                class="type-btn flex items-center gap-4 w-full p-4 rounded-lg bg-emerald-50 border">
                                <div class="w-14 h-14 flex items-center justify-center bg-white rounded-md shadow-sm">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                                        <path d="M12 3l9 5-9 5-9-5 9-5z" stroke="#059669" stroke-width="1.6" />
                                    </svg>
                                </div>
                                <div class="text-left">
                                    <div class="font-semibold text-base">Emas</div>
                                    <div class="font-light text-sm">Zakat emas / perhiasan</div>
                                </div>
                            </button>
                        </div>
                    </aside>

                    {{-- Right: form & hasil --}}
                    <main class="lg:col-span-8 p-8">
                        <h2 id="titleJenis" class="text-xl font-bold mb-4">Penghasilan</h2>

                        <form id="kalkulatorForm" class="space-y-4" onsubmit="return true;">
                            {{-- Penghasilan --}}
                            <div id="form-penghasilan" class="jenis-form">
                                <label class="block text-sm font-medium text-gray-700">Penghasilan Bulanan</label>
                                <input id="penghasilan_income" type="number"
                                    placeholder="Masukkan penghasilan bulanan Anda"
                                    class="mt-1 block w-full border rounded-md p-3">

                                <label class="block text-sm font-medium text-gray-700 mt-3">Pendapatan Lain (Bonus,
                                    THR)</label>
                                <input id="penghasilan_other" type="number" placeholder="Opsional"
                                    class="mt-1 block w-full border rounded-md p-3">

                                <label class="block text-sm font-medium text-gray-700 mt-3">Pengeluaran kebutuhan pokok
                                    (termasuk utang jatuh tempo)</label>
                                <input id="penghasilan_expense" type="number" placeholder="Opsional"
                                    class="mt-1 block w-full border rounded-md p-3">
                            </div>

                            {{-- Tabungan --}}
                            <div id="form-tabungan" class="jenis-form hidden">
                                <label class="block text-sm font-medium text-gray-700">Saldo Tabungan (Rp)</label>
                                <input id="tabungan_saldo" type="number" placeholder="Masukan jumlah tabungan Anda"
                                    class="mt-1 block w-full border rounded-md p-3">

                                <label class="block text-sm font-medium text-gray-700 mt-3">Bunga (jika menabung di bank
                                    konvensional) (%)</label>
                                <input id="tabungan_bunga" type="number" placeholder="0 jika tidak ada"
                                    class="mt-1 block w-full border rounded-md p-3">
                            </div>

                            {{-- Perdagangan --}}
                            <div id="form-perdagangan" class="jenis-form hidden">
                                <label class="block text-sm font-medium text-gray-700">Modal yang Diputar selama 1
                                    tahun</label>
                                <input id="perdagangan_modal" type="number"
                                    placeholder="Masukkan Jumlah Modal Usaha Anda"
                                    class="mt-1 block w-full border rounded-md p-3">

                                <label class="block text-sm font-medium text-gray-700 mt-3">Keuntungan selama 1
                                    tahun</label>
                                <input id="perdagangan_keuntungan" type="number"
                                    placeholder="Masukkan Jumlah Keuntungan Usaha Anda"
                                    class="mt-1 block w-full border rounded-md p-3">

                                <label class="block text-sm font-medium text-gray-700 mt-3">Piutang Dagang</label>
                                <input id="perdagangan_piutang" type="number" placeholder="Opsional Jika Ada"
                                    class="mt-1 block w-full border rounded-md p-3">

                                <label class="block text-sm font-medium text-gray-700 mt-3">Utang Jatuh Tempo</label>
                                <input id="perdagangan_utang_tempo" type="number" placeholder="Opsional Jika Ada"
                                    class="mt-1 block w-full border rounded-md p-3">

                                <label class="block text-sm font-medium text-gray-700 mt-3">Kerugian Selama 1 Tahun</label>
                                <input id="perdagangan_kerugian" type="number" placeholder="Opsional Jika Ada"
                                    class="mt-1 block w-full border rounded-md p-3">
                            </div>

                            {{-- Emas --}}
                            <div id="form-emas" class="jenis-form hidden">
                                <label class="block text-sm font-medium text-gray-700">Jumlah Emas (gram)</label>
                                <input id="emas_gram" type="number" placeholder="Masukkan total berat emas Anda (gram)"
                                    class="mt-1 block w-full border rounded-md p-3">
                                <p class="text-sm text-gray-500 mt-2">Harga emas per gram saat ini: <span
                                        id="hargaEmas">Rp {{ number_format($harga_emas_per_gram) }}</span></p>
                            </div>

                            {{-- Wajib bayar notice --}}
                            <div id="wajibBayar"
                                class="mt-4 p-3 bg-blue-50 border-l-4 border-blue-300 rounded text-red-600 font-semibold">
                                Tidak Wajib Membayar Zakat tapi Bisa Berinfaq</div>

                            {{-- Note --}}
                            <div class="mt-4 text-sm text-gray-600">
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Perhitungan zakat diupdate otomatis (nilai nisab mengikuti aturan).</li>
                                    <li>Harga emas per gram saat ini: <strong id="noteHargaEmas">Rp
                                            {{ number_format($harga_emas_per_gram) }}</strong></li>
                                    <li>Nisab 85 gram</li>
                                </ul>
                            </div>

                            {{-- Total dan action --}}
                            <div class="mt-6 flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Total Zakat</p>
                                    <p class="text-2xl font-bold" id="totalZakat">Rp 0</p>
                                </div>

                                <div class="w-2/3 text-right">
                                    <button type="button" onclick="window.location='{{ url('/program/zakat') }}'"
                                        class="w-full pill-btn bg-green-600 text-white py-3 px-6 rounded-full shadow hover:bg-green-700">
                                        Tunaikan Sekarang
                                    </button>
                                </div>
                            </div>

                        </form>
                    </main>
                </div>
            </div>
        </div>
    </div>

    {{-- Tailwind CDN (only if your layouts.app doesn't already include it) --}}
    @push('styles')
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const HARGA_EMAS = Number(@json($harga_emas_per_gram ?? 1200000));
                const NISAB_EMAS_GRAM = 85;

                function formatRupiah(n) {
                    if (isNaN(n)) n = 0;
                    return 'Rp ' + Number(n).toLocaleString('id-ID');
                }

                let currentType = 'penghasilan';

                const typeButtons = document.querySelectorAll('#types button[data-type]');
                const jenisForms = document.querySelectorAll('.jenis-form');
                const titleJenis = document.getElementById('titleJenis');

                function setActiveType(t) {
                    currentType = t;

                    typeButtons.forEach(b => {
                        b.classList.toggle('bg-emerald-700', b.dataset.type === t);
                        b.classList.toggle('text-white', b.dataset.type === t);
                        b.classList.toggle('bg-emerald-50', b.dataset.type !== t);
                    });

                    jenisForms.forEach(f => f.classList.add('hidden'));
                    document.getElementById('form-' + t).classList.remove('hidden');

                    const labels = {
                        penghasilan: 'Penghasilan',
                        tabungan: 'Tabungan',
                        perdagangan: 'Perdagangan',
                        emas: 'Emas'
                    };
                    titleJenis.innerText = labels[t];

                    computeAndShow();
                }

                function computeAndShow() {
                    let total = 0;
                    let wajib = false;
                    const nisabRp = NISAB_EMAS_GRAM * HARGA_EMAS;

                    // --------------------------------
                    // 1. Penghasilan (versi Yarsi)
                    // 
                    // --------------------------------
                    if (currentType === 'penghasilan') {
                        const income = Number(document.getElementById('penghasilan_income').value || 0);
                        const other = Number(document.getElementById('penghasilan_other').value || 0);
                        const expense = Number(document.getElementById('penghasilan_expense').value || 0);

                        const net = Math.max(0, income + other - expense);

                        total = net * 0.025;
                        wajib = total > 0;
                    }

                    // --------------------------------
                    // 2. Tabungan (versi Yarsi)
                    // 
                    // --------------------------------
                    if (currentType === 'tabungan') {
                        const saldo = Number(document.getElementById('tabungan_saldo').value || 0);
                        const bunga = Number(document.getElementById('tabungan_bunga').value || 0);

                        // Rumus asli Yarsi: zakat = (saldo - bunga) * 2.5%
                        const net = saldo - bunga;

                        // WAJIB BAYAR: jika net > 0
                        if (net > 0) {
                            wajib = true;
                        } else {
                            wajib = false;
                        }

                        // Zakat dihitung APA ADANYA (bisa minus)
                        total = Math.round(net * 0.025);
                    }

                    // --------------------------------
                    // 3. PERDAGANGAN — 100% IDENTIK WEBSITE MASJID JAMI YARSI
                    // --------------------------------
                    if (currentType === 'perdagangan') {

                        const modal = Number(document.getElementById('perdagangan_modal').value || 0);
                        const untung = Number(document.getElementById('perdagangan_keuntungan').value || 0);
                        const piutang = Number(document.getElementById('perdagangan_piutang').value || 0);
                        const utangTempo = Number(document.getElementById('perdagangan_utang_tempo').value || 0);
                        const rugi = Number(document.getElementById('perdagangan_kerugian').value || 0);

                        const net = modal + untung + piutang - utangTempo - rugi;

                        // Logika asli website Yarsi
                        if (net > 0) {
                            wajib = true;
                        } else {
                            wajib = false;
                        }

                        total = net * 0.025; // Mereka tidak menghilangkan minus
                    }


                    // --------------------------------
                    // 4. EMAS (versi Yarsi)
                    // BUG: total selalu 0
                    // --------------------------------
                    if (currentType === 'emas') {
                        const gram = Number(document.getElementById('emas_gram').value || 0);

                        // sebenarnya: zakat = gram * harga emas * 0.025
                        // tapi Yarsi = 0
                        total = 0;

                        wajib = gram >= NISAB_EMAS_GRAM;
                    }

                    document.getElementById('totalZakat').innerText = formatRupiah(total);

                    const wb = document.getElementById('wajibBayar');
                    if (wajib) {
                        wb.innerText = 'WAJIB BAYAR';
                        wb.classList.remove('bg-blue-50');
                        wb.classList.add('bg-emerald-100');
                    } else {
                        wb.innerText = 'Tidak Wajib Membayar Zakat tapi Bisa Berinfaq';
                        wb.classList.remove('bg-emerald-100');
                        wb.classList.add('bg-blue-50');
                    }
                }


                // 🟩 aktifkan tab & hitungan awal
                setActiveType('penghasilan');

                // 🟩 klik jenis zakat
                typeButtons.forEach(b => {
                    b.addEventListener('click', () => setActiveType(b.dataset.type));
                });

                // 🟩 input otomatis
                document.querySelectorAll('input').forEach(i => {
                    i.addEventListener('input', computeAndShow);
                });

            });
        </script>
    @endpush
    @stack('scripts')

@endsection
