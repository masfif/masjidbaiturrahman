<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('donasis', function (Blueprint $table) {
        $table->date('tanggal_transaksi')->nullable()->after('status');
    });
}

public function down()
{
    Schema::table('donasis', function (Blueprint $table) {
        $table->dropColumn('tanggal_transaksi');
    });
}

};
