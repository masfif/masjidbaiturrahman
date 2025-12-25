<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DonasiOffline extends Model
{
    use HasFactory;

    protected $table = 'donasis';

    protected $fillable = [
        'program_id',
        'nama_donatur',
        'telepon',
        'email',
        'nominal',
        'metode',
        'status',
        'tanggal_transaksi',
        'bukti_foto'
    ];

    protected $casts = [
        'tanggal_transaksi' => 'date',];
    

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
