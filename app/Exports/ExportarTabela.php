<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

// Colunas de tamanhos automáticos
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

// Colunas estilizadas
//use Maatwebsite\Excel\Concerns\WithStyles;
//use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportarTabela implements FromCollection, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $colunas;

    public function __construct($colunas)
    {
        $this->colunas = $colunas;
    }

//    private function styles(Worksheet $sheet)
//    {
//        $sheet->mergeCells('A1:F1');
//
//        $sheet->getStyle('A1:F1')->getFont()->setBold(true);
//
//        $sheet->getStyle('A2:F2')->getFont()->setBold(true);
//
//    }

    public function collection()
    {
        return collect($this->colunas);
    }
}
