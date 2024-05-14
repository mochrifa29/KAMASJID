<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'tb_kategori';
    protected $guarded = ['id'];

    public function kas_masuk() {
        return $this->hasMany(Kas_masuk::class,'id_kategori');
    }

    public function kas_keluar() {
        return $this->hasMany(Kas_keluar::class,'id_kategori');
    }
}
