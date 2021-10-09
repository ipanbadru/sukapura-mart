<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $table = 'pelanggan';

    protected $guarded = ['id'];
    protected $with = ['tagihan'];

    public $timestamps = false;

    public function tagihan()
    {
        return $this->hasMany(Tagihan::class, 'id_pelanggan');
    }

    public function scopeGetTagihan($query)
    {
        return $query->whereHas('tagihan', function($q) {
            $q->where('id_transaksi', null);
        });
    }
    
    public function getJumlahTagihanAttribute()
    {
        $total = $this->tagihan->sum('total_tagihan');
        return  'Rp. ' . number_format($total, 0, '.', '.');
    }
}
