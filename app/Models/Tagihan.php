<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;
    protected $table = 'tagihan';

    protected $guarded = ['id'];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function detail()
    {
        return $this->hasMany(TagihanDetail::class, 'id_tagihan');
    }

    public function kasir()
    {
        return $this->belongsTo(User::class, 'id_kasir');
    }

    public function scopeGetTagihanPelanggan($query, $search)
    {
        return $query->where('id_transaksi', null)->whereHas('pelanggan', function($q) use ($search) {
            return $q->where('nama_pelanggan', 'like', '%' . $search . '%');
        });
    }

    public function getTotalTagihanAttribute($value)
    {
        return 'Rp. ' . number_format($value, 0, '.', '.');
    }

    public function setTotalTagihanAttribute($value)
    {
        $this->attributes['total_tagihan'] = preg_replace('/\D/', '', $value);
    }

    public function getTotalHargaAttribute($value)
    {
        return 'Rp. ' . number_format($value, 0, '.', '.');
    }

    public function getTerbayarAttribute()
    {
        $terbayar = $this->attributes['total_harga'] - $this->attributes['total_tagihan'];
        return 'Rp. ' . number_format($terbayar, 0, '.', '.');
    }
}
