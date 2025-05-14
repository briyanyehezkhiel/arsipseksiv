<?php

namespace App\Exports;

use App\Models\PN;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class PNExport implements FromCollection, WithHeadings, WithCustomStartCell
{
    public function startCell(): string
    {
        return 'A3';
    }

    public function collection()
    {
        return PN::select(
            'tahun',
            'no_register_perkara',
            'penggugat',
            'tergugat',
            'objek_perkara',
            'tk1',
            'banding',
            'kasasi',
            'pk',
            'tipologi_kasus',
            'menang',
            'kalah',
            'keterangan',
            'justicia'
        )
        ->orderBy('id', 'desc')
        ->get();
    }

    public function headings(): array
    {
        return [
            'Tahun',
            'No Register Perkara',
            'Penggugat',
            'Tergugat',
            'Objek Perkara',
            'TK1',
            'Banding',
            'Kasasi',
            'PK',
            'Tipologi Kasus',
            'Menang',
            'Kalah',
            'Keterangan',
            'Justicia',
        ];
    }
}
