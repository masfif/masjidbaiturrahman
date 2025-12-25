@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto p-6">

        <h2 class="text-2xl font-semibold mb-6">
            Hasil pencarian: "{{ $q }}"
        </h2>

        @if ($results->isEmpty())
            <p class="text-gray-600">Tidak ada program ditemukan.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach ($results as $p)
                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">

                        <img src="{{ asset('storage/' . $p->gambar) }}" alt="{{ $p->judul }}"
                            class="w-full h-44 object-cover">

                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1">{{ $p->judul }}</h3>

                            <p class="text-gray-700 text-sm">
                                {{ Str::limit(strip_tags($p->deskripsi), 120) }}
                            </p>

                            <p class="text-xs text-green-700 mt-3 font-semibold">
                                Kategori: {{ $p->kategori }}
                            </p>

                            <a href="{{ route('program.detail', [
                                'kategori' => strtolower($p->kategori),
                                'slug' => $p->slug,
                            ]) }}"
                                class="inline-block mt-4 px-4 py-2 bg-green-600 text-white text-sm rounded hover:bg-green-700">
                                Lihat Detail
                            </a>

                        </div>
                    </div>
                @endforeach

            </div>
        @endif
    </div>
@endsection
