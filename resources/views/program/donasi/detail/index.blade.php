@extends('layouts.app')

@section('title', $item->judul)

@push('styles')
<style>
    .mobile-frame {
        max-width: 480px;
        margin: 0 auto;
        background: white;
        min-height: 100vh;
    }
    .tinymce-content p { margin: 0 0 .75rem; }
    .tinymce-content ul,
    .tinymce-content ol {
        margin: .5rem 0 .75rem 1.2rem;
        padding-left: 1.2rem;
    }
</style>
@endpush

@section('content')

@php
    $terkumpul = $item->terkumpul ?? 0;
    $target = $item->target_dana ?? 1;
    $persen = min(100, ($terkumpul / $target) * 100);
@endphp

<div class="mobile-frame"
    x-data="{
        openModal:false,
        openShare:false,
        nominal:0,
        minNominal: {{ $item->min_donasi }},
        custom: {{ json_encode($item->custom_nominal ?? []) }},

        dragY: 0,
        startY: 0,
        dragging: false,

        startDrag(e) {
            this.dragging = true
            this.startY = e.touches ? e.touches[0].clientY : e.clientY
        },

        onDrag(e) {
            if (!this.dragging) return
            const currentY = e.touches ? e.touches[0].clientY : e.clientY
            this.dragY = Math.max(0, currentY - this.startY)
        },

        endDrag(close) {
            this.dragging = false
            if (this.dragY > 120) close()
            this.dragY = 0
        },

        pilih(n){
            this.nominal = n;
        },

        donasiSekarang(){
            if (this.nominal < this.minNominal) {
                alert('Nominal minimal donasi adalah Rp ' + this.minNominal.toLocaleString('id-ID'));
                return;
            }
            document.getElementById('formDonasi').submit();
        }
    }"
>

    {{-- ================= HEADER IMAGE ================= --}}
    <div class="relative w-full h-64 overflow-hidden mb-5">
        <a href="/"
            class="absolute top-4 left-4 z-10 flex items-center gap-2
                   bg-white/20 backdrop-blur-md
                   px-3 py-1.5 rounded-full shadow">
            <i class="bi bi-house-door text-green-700 text-lg"></i>
            <span class="font-medium text-gray-800 text-sm">Home</span>
        </a>

        <img
            src="{{ $item->foto ? asset('storage/' . $item->foto) : asset('assets/img/Image-not-found.png') }}"
            alt="{{ $item->judul }}"
            class="w-full h-full bg-gray-100"
        >
    </div>

    {{-- ================= MAIN CONTENT ================= --}}
    <div class="p-6 -mt-6 bg-white rounded-t-3xl shadow-md space-y-4">

        <h1 class="text-xl font-bold leading-snug">
            {{ $item->judul }}
        </h1>

        <div class="text-sm text-gray-700">
            <b>Rp {{ number_format($terkumpul,0,',','.') }}</b>
            terkumpul dari
            <b>Rp {{ number_format($item->target_dana, 0, ',', '.') }}</b>
        </div>

        <div class="w-full bg-gray-200 rounded-full h-2">
            <div class="bg-green-600 h-2 rounded-full"
                 style="width: {{ $persen }}%">
            </div>
        </div>

        <p class="text-xs text-gray-500">
            {{ number_format($persen, 0) }}% tercapai
        </p>

        <div class="flex justify-between text-gray-600 text-xs w-full">
            <span>{{ $jumlahDonasi }} Donasi</span>
            <div class="flex flex-col items-end">
                <span class="font-medium">Sisa Waktu:</span>
                <span>{{ $sisaHari }}</span>
            </div>
        </div>

        <button
            class="w-full py-3 bg-green-600 text-white rounded-lg font-semibold"
            @click="openModal = true">
            Infaq Sekarang!
        </button>
    </div>

    {{-- ================= MODAL SHARE ================= --}}
    <div x-show="openShare"
        x-transition.opacity
        class="fixed inset-0 bg-black/60 flex items-end justify-center z-50"
        @click.self="openShare = false">

        <div
            x-transition.origin.bottom
            :style="`transform: translateY(${dragY}px)`"
            class="bg-white w-full max-w-[480px] mx-auto p-6 rounded-t-2xl">

            <div class="w-16 h-1 bg-gray-300 rounded-full mx-auto mb-4"></div>

            <h2 class="text-lg font-bold mb-4 text-center">
                Bagikan Donasi
            </h2>

            <div class="grid grid-cols-3 gap-4 text-center text-sm">

                <a
                    :href="`https://wa.me/?text=${encodeURIComponent('{{ $item->judul }} - ' + window.location.href)}`"
                    target="_blank"
                    class="flex flex-col items-center gap-2">
                    <i class="bi bi-whatsapp text-3xl text-green-600"></i>
                    WhatsApp
                </a>

                <a
                    :href="`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(window.location.href)}`"
                    target="_blank"
                    class="flex flex-col items-center gap-2">
                    <i class="bi bi-facebook text-3xl text-blue-600"></i>
                    Facebook
                </a>

                <a
                    :href="`https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(window.location.href)}`"
                    target="_blank"
                    class="flex flex-col items-center gap-2">
                    <i class="bi bi-linkedin text-3xl text-blue-700"></i>
                    LinkedIn
                </a>

                <a
                    :href="`https://social-plugins.line.me/lineit/share?url=${encodeURIComponent(window.location.href)}`"
                    target="_blank"
                    class="flex flex-col items-center gap-2">
                    <i class="bi bi-chat-dots text-3xl text-green-500"></i>
                    LINE
                </a>

                <a
                    :href="`mailto:?subject={{ $item->judul }}&body=${encodeURIComponent(window.location.href)}`"
                    class="flex flex-col items-center gap-2">
                    <i class="bi bi-envelope text-3xl text-gray-700"></i>
                    Email
                </a>

                <button
                    @click="
                        navigator.clipboard.writeText(window.location.href)
                        .then(() => alert('Link berhasil disalin ke clipboard!'))
                    "
                    class="flex flex-col items-center gap-2">
                    <i class="bi bi-link-45deg text-3xl text-gray-700"></i>
                    Salin Link
                </button>

            </div>

            <button
                class="w-full mt-6 py-3 border rounded-lg font-semibold"
                @click="openShare = false">
                Tutup
            </button>
        </div>
    </div>

</div>

@endsection
