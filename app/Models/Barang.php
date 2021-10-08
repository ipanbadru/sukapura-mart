<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Picqer\Barcode\BarcodeGeneratorHTML;
use Picqer\Barcode\BarcodeGeneratorPNG;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $guarded = ['id'];

    public function getHargaBeliAttribute($value)
    {
        return 'Rp. ' . number_format($value, 0, '.', '.');
    }

    public function getNumHargaBeliAttribute()
    {
        return $this->attributes['harga_beli'];
    }

    public function getHargaJualAttribute($value)
    {
        return 'Rp. ' . number_format($value, 0, '.', '.');
    }

    public function getNumHargaJualAttribute()
    {
        return $this->attributes['harga_jual'];
    }

    public function getBarcodeAttribute()
    {
        $generator = new BarcodeGeneratorPNG();
        return '<img class="w-40 h-11" src="data:image/png;base64,' . base64_encode($generator->getBarcode($this->kode_barang, $generator::TYPE_CODE_128)) . '">';
        
    }
    public function setHargaBeliAttribute($value)
    {
        if(is_int($value)){
            $this->attributes['harga_beli'] = $value;
        }else{
            $value = str_replace('Rp. ', '', $value);
            $this->attributes['harga_beli'] = str_replace('.', '', $value);
        }
    }

    public function setHargaJualAttribute($value)
    {
        if(is_int($value)){
            $this->attributes['harga_jual'] = $value;
        }else{
            $value = str_replace('Rp. ', '', $value);
            $this->attributes['harga_jual'] =  str_replace('.', '', $value);
        }
    }
}
