<?php

namespace App\Exports;

use App\Models\Tagihan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use phpDocumentor\Reflection\DocBlock\Tag;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TagihanExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths, WithColumnFormatting
{
        /**
        * @return \Illuminate\Support\Collection
        */
        protected $row = 1;
        public function collection()
        {
            $laporanData = collect([]);
            $tagihan = Tagihan::where('id_transaksi', null)->get();
            foreach($tagihan as $item)
            {
                foreach($item->detail as $detail)
                {
                    $laporanData->push([$this->row++, $item->id, $item->pelanggan->nama_pelanggan, date('d-m-Y', strtotime($item->created_at)), $detail->barang->nama_barang, $detail->total_barang, $detail->harga_barang_num]);
                }
            }
            return $laporanData;
        }
    
        public function headings(): array
        {
            return ['No', 'Id Tagihan', 'Nama Pelanggan', 'Tanggal Credit', 'Nama Barang', 'Jumlah Barang', 'Total'];
        }
    
        public function styles(Worksheet $sheet)
        {
            $sheet->getStyle('A1:G' . $this->row)->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\phpspreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['rgb' => '18181b'],
                    ],
                ],
            ]);
            $sheet->getStyle('A:A' . $this->row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
            $sheet->getStyle('B2:B' . $this->row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('F2:F' . $this->row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('G2:G' . $this->row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
        }
        public function columnWidths(): array
        {
            return [
                'A' => 5,
                'B' => 12,
                'C' => 12,
                'D' => 18,
                'E' => 32, 
                'F' => 14, 
                'G' => 13, 
            ];
        }
    
        public function columnFormats(): array
        {
            return [
                'G' => NumberFormat::FORMAT_CURRENCY_RP,
            ];
        }
    
}
