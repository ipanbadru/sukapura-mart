<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BarangExport implements FromCollection, WithStyles, WithColumnWidths, WithHeadings, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $allBarang = Barang::get();
        $newBarang = collect([]);
        $no = 1;
        foreach($allBarang as $barang){
            $newBarang->push([$no++, $barang->kode_barang, $barang->nama_barang, $barang->num_harga_beli, $barang->num_harga_jual, $barang->jumlah_barang]);
        }
        return $newBarang;
    }

    public function headings(): array
    {
        return ["No", "Kode Barang", "Nama Barang", "Harga Beli", "Harga Jual", "Stok Barang"];
    }

    public function styles(Worksheet $sheet)
    {
        $row = Barang::get()->count() + 1;
        $sheet->getStyle('A1:F' . $row)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\phpspreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '18181b'],
                ],
            ],
        ]);
        $sheet->getStyle('A:B')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('D2:E' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle('F2:F' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 21,
            'C' => 32,
            'D' => 17.30, 
            'E' => 17.30, 
            'F' => 11.30, 
        ];
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_CURRENCY_RP,
            'E' => NumberFormat::FORMAT_CURRENCY_RP,
        ];
    }
}
