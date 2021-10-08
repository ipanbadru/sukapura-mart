<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Barang;
use Illuminate\Database\Eloquent\Factories\Factory;

class BarangFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Barang::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kode_barang' => Str::random(10),
            'nama_barang' => $this->faker->sentence(),
            'harga_beli' => 12000,
            'harga_jual' => 10000,
            'jumlah_barang' => 200,
        ];
    }
}
