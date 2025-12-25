<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('donasis', function (Blueprint $table) {
        $table->string('bukti_foto')->nullable()->after('nominal');
    });
}

public function down()
{
    Schema::table('donasis', function (Blueprint $table) {
        $table->dropColumn('bukti_foto');
    });
}

};
