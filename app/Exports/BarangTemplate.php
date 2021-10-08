<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BarangTemplate implements FromCollection, WithStyles, WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect([["No", "Kode Barang", "Nama Barang", "Harga Beli", "Harga Jual", "Stok Barang"]]);
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:F100')->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\phpspreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '18181b'],
                ],
            ],
        ]);
        $sheet->getStyle('A:B')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('D2:E100')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle('F2:F100')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
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
}
