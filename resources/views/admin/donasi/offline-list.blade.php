@extends('admin.components.app')

@section('title', 'Daftar Donasi Offline')

@section('content')
    <div x-data="{
        start: '{{ request('start_date') }}',
        end: '{{ request('end_date') }}',
    }">
        <!-- HEADER + BREADCRUMB -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-green-700">Donasi Offline</h1>

            <nav class="text-sm text-gray-600">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-green-700 hover:underline">Home</a>
                <span class="mx-1">›</span>
                <span class="font-semibold text-gray-800">Donasi Offline</span>
            </nav>
        </div>

        <!-- TOP BAR -->
        <div class="flex flex-wrap items-center justify-between gap-3 mb-6">

            <a href="{{ route('admin.donasi.offline.create') }}"
                class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-800">
                + Tambah Donasi Offline
            </a>

            <div class="flex items-center gap-3">

                <!-- DATE RANGE PICKER -->
                <div>
                    <button id="dateRangePickerButton" data-dropdown-toggle="dateRangePicker"
                        class="px-3 py-2 w-64 border rounded-lg shadow text-left bg-white">
                        <span x-text="start ? (start + ' → ' + end) : 'Pilih Rentang Tanggal'"></span>
                    </button>

                    <div id="dateRangePicker" class="z-50 hidden bg-white rounded-lg shadow w-72 p-4 mt-2">
                        <div class="mb-4">
                            <h4 class="font-medium text-sm mb-2">Quick Select</h4>
                            <div class="grid grid-cols-2 gap-2">
                                <button class="px-2 py-2 bg-gray-100 rounded"
                                    @click="
                                start = '{{ now()->toDateString() }}';
                                end = '{{ now()->toDateString() }}';
                            ">Today</button>
                                <button class="px-2 py-2 bg-gray-100 rounded"
                                    @click="
                                start = '{{ now()->startOfWeek()->toDateString() }}';
                                end = '{{ now()->endOfWeek()->toDateString() }}';
                            ">This
                                    Week</button>
                                <button class="px-2 py-2 bg-gray-100 rounded"
                                    @click="
                                start = '{{ now()->startOfMonth()->toDateString() }}';
                                end = '{{ now()->endOfMonth()->toDateString() }}';
                            ">This
                                    Month</button>
                                <button class="px-2 py-2 bg-gray-100 rounded"
                                    @click="
                                start = '{{ now()->subMonth()->startOfMonth()->toDateString() }}';
                                end = '{{ now()->subMonth()->endOfMonth()->toDateString() }}';
                            ">Last
                                    Month</button>
                            </div>
                        </div>

                        <div>
                            <h4 class="font-medium text-sm mb-2">Custom Range</h4>
                            <input type="date" x-model="start" class="border rounded px-2 py-1 w-full mb-2">
                            <input type="date" x-model="end" class="border rounded px-2 py-1 w-full">
                        </div>

                        <form method="GET" class="mt-3">
                            <input type="hidden" name="start_date" :value="start">
                            <input type="hidden" name="end_date" :value="end">
                            <button type="submit"
                                class="mt-3 w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700">
                                Apply
                            </button>
                        </form>
                    </div>
                </div>

                <!-- SEARCH -->
                <form>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Pencarian"
                        class="px-3 py-2 border rounded-lg shadow w-48">
                </form>

            </div>
        </div>

        <!-- TABLE -->
        <div class="bg-white shadow-lg rounded-xl p-4">

            <table class="w-full">
                <thead>
                    <tr class="border-b bg-gray-50 text-gray-600 text-sm">
                        <th class="py-3 px-4 font-semibold">Nama Donatur</th>
                        <th class="py-3 px-4 font-semibold">Email</th>
                        <th class="py-3 px-4 font-semibold">Telepon</th>
                        <th class="py-3 px-4 font-semibold">Program</th>
                        <th class="py-3 px-4 font-semibold">Nominal</th>
                        <th class="py-3 px-4 font-semibold">Metode</th>
                        <th class="py-3 px-4 font-semibold">Status</th>
                        <th class="py-3 px-4 font-semibold">Tanggal Transaksi</th>
                        <th class="py-3 px-4 font-semibold">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($donasiOffline as $donasi)
                        <tr class="border-b hover:bg-gray-50 transition">

                            <td class="py-4 px-4">{{ $donasi->nama_donatur }}</td>
                            <td class="py-4 px-4">{{ $donasi->email ?? '-' }}</td>
                            <td class="py-4 px-4">{{ $donasi->telepon }}</td>
                            <td class="py-4 px-4">{{ $donasi->program }}</td>
                            <td class="py-4 px-4 font-semibold text-gray-800">
                                Rp {{ number_format($donasi->nominal, 0, ',', '.') }}
                            </td>
                            <td class="py-4 px-4">{{ ucfirst($donasi->metode) }}</td>
                            <td class="py-4 px-4">{{ ucfirst($donasi->status) }}</td>
                            <td class="py-4 px-4">{{ $donasi->tanggal_transaksi ?? '-' }}</td>

                            <td class="py-4 px-4 flex gap-2">

                                {{-- SHOW --}}
                                <a href="{{ route('admin.donasi.offline.show', $donasi->id) }}"
                                    class="px-3 py-1 bg-blue-600 text-white rounded-lg text-sm shadow hover:bg-blue-800">
                                    Show
                                </a>

                                {{-- EDIT --}}
                                <a href="{{ route('admin.donasi.offline.edit', $donasi->id) }}"
                                    class="px-3 py-1 bg-yellow-500 text-white rounded-lg text-sm shadow hover:bg-yellow-600">
                                    Edit
                                </a>

                                {{-- DELETE --}}
                                <form action="{{ route('admin.donasi.offline.destroy', $donasi->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus donasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="px-3 py-1 bg-red-600 text-white rounded-lg text-sm shadow hover:bg-red-700">
                                        Hapus
                                    </button>
                                </form>

                            </td>


                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-4 py-3 text-center text-gray-500">
                                Belum ada donasi offline.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4">
                {{ $donasiOffline->links() }}
            </div>

        </div>
    </div>
@endsection
