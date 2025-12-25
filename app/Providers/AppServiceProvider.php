<?php
namespace App\Providers;

use App\Models\Donasi;
use App\Models\KontakInformasi;
use App\Models\Program;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        /*
        |--------------------------------------------------------------------------
        | KATEGORI PROGRAM GLOBAL
        |--------------------------------------------------------------------------
        */
        $defaultKategori = ['Zakat', 'Infak', 'Sedekah', 'Wakaf', 'Hibah'];

        $kategoriDB = [];

        if (Schema::hasTable('programs')) {
            try {
                $kategoriDB = Program::select('kategori')
                    ->distinct()
                    ->pluck('kategori')
                    ->toArray();
            } catch (\Throwable $e) {
                $kategoriDB = [];
            }
        }

        $kategoriProgram = array_unique(array_merge($defaultKategori, $kategoriDB));

        View::share('kategoriProgram', $kategoriProgram);


        /*
        |--------------------------------------------------------------------------
        | LOGO GLOBAL
        |--------------------------------------------------------------------------
        */
        $logo = asset('assets/img/logo1.png'); // default

        if (Schema::hasTable('kontak_informasis')) {
            try {
                $kontak = KontakInformasi::first();
                if ($kontak && $kontak->logo) {
                    $logo = asset('storage/' . $kontak->logo);
                }
            } catch (\Throwable $e) {
                // abaikan agar tidak error
            }
        }

        View::share('logo', $logo);


        /*
        |--------------------------------------------------------------------------
        | NOTIFIKASI ADMIN (KHUSUS NAVBAR ADMIN)
        |--------------------------------------------------------------------------
        */
        View::composer('admin.components.navbar', function ($view) {

            $notifDonasi = 0;
            $latestDonasi = collect([]);

            if (Schema::hasTable('donasis')) {
                try {
                    $notifDonasi = Donasi::where('is_read_admin', false)
                        ->whereIn('status', ['pending', 'paid'])
                        ->count();

                    $latestDonasi = Donasi::latest()
                        ->limit(5)
                        ->get();
                } catch (\Throwable $e) {
                    $notifDonasi = 0;
                    $latestDonasi = collect([]);
                }
            }

            $view->with([
                'notifDonasi' => $notifDonasi,
                'latestDonasi' => $latestDonasi,
            ]);
        });
    }
}