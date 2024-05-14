<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rekapKas_masjid extends Model
{
    use HasFactory;
    protected $table = 'tb_rekap_kas_masjid';
    protected $guarded = ['id'];
    protected $with = ['kategori'];

    public function kategori() {
        return $this->belongsTo(Kategori::class,'id_kategori');
    }
}
