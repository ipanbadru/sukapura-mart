<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PelangganTemplate implements FromCollection, WithColumnWidths, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect([["No", "Nik", "Nama Pelanggan", "No Hp"]]);
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:D100')->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\phpspreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '18181b'],
                ],
            ],
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 20,
            'C' => 25,
            'D' => 18, 
        ];
    }
}
