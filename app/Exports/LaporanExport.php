<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $data, $row = 1;
    public function __construct($dataTransaksi)
    {
        $this->data = $dataTransaksi;
    }
    public function collection()
    {
        $laporanData = collect([]);
        $no = 1;
        foreach($this->data as $transaki)
        {
            foreach($transaki->detail as $detail)
            {
                $this->row += 1;
                $laporanData->push([$no++, $transaki->id, date('d-m-Y', strtotime($transaki->created_at)), $detail->barang->nama_barang, $detail->total_barang, $detail->harga_barang]);
            }
        }
        return $laporanData;
    }

    public function headings(): array
    {
        return ['No', 'Id Transaksi' , 'Tanggal Transaksi', 'Nama Barang', 'Jumlah Barang', 'Total'];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:F' . $this->row)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\phpspreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '18181b'],
                ],
            ],
        ]);
        $sheet->getStyle('A:A' . $this->row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('B2:B' . $this->row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('E2:E' . $this->row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('F2:F' . $this->row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
    }
    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 12,
            'C' => 18,
            'D' => 32, 
            'E' => 14, 
            'F' => 13, 
        ];
    }

    public function columnFormats(): array
    {
        return [
            'F' => NumberFormat::FORMAT_CURRENCY_RP,
        ];
    }
}
