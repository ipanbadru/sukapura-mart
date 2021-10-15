<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihanDetail extends Model
{
    use HasFactory;

    protected $table = 'tagihan_detail';

    protected $guarded = ['id'];

    protected $with = ['barang'];

    public $timestamps = false;
    
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function getHargaBarangAttribute($value)
    {
        return 'Rp. ' . number_format($value, 0, '.', '.');
    }

    public function getHargaBarangNumAttribute()
    {
        return $this->attributes['harga_barang'];
    }

}
