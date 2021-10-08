<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $guarded = ['id'];

    public function getTotalHargaAttribute($value)
    {
        return 'Rp. ' . number_format($value, 0, '.', '.');
    }

    public function getJumlahBayarAttribute($value)
    {
        return 'Rp. ' . number_format($value, 0, '.', '.');
    }

    public function getKembalianAttribute($value)
    {
        return 'Rp. ' . number_format($value, 0, '.', '.');
    }

    public function detail()
    {
        return $this->hasMany(TransaksiDetail::class, 'id_transaksi');
    }

    public function scopeFilterLaporan($query, array $filters)
    {
        if(isset($filters['data'])){
            $data = $filters['data'];
            if($data === 'harian'){
                return $query->whereDate('created_at', $filters['tgl']);
            }else if($data === 'mingguan'){
                return $query->whereBetween('created_at', [$filters['tgl_mulai'], $filters['tgl_akhir']]);
            }else if($data === 'bulanan'){
                return $query->whereMonth('created_at', $filters['bulan'] + 1)
                        ->whereYear('created_at', $filters['tahun']);
            }
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_kasir');
    }
}
