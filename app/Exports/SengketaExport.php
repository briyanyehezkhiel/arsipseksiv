<?php

namespace App\Exports;

use App\Models\Sengketa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class SengketaExport implements FromCollection, WithHeadings, WithCustomStartCell
{
    public function startCell(): string
    {
        return 'A3'; // Heading di baris ke-4, data mulai baris ke-5
    }

    public function collection()
    {
        return Sengketa::select(
            'tahun',
            'pemohon',
            'termohon',
            'objek',
            'pokok_masalah',
            'progress_penyelesaian',
            'konseptor',
            'k1',
            'k2',
            'k3'
        )
        ->orderBy('id', 'desc')
        ->get();
    }

    public function headings(): array
    {
        return [
            'Tahun',
            'Pemohon',
            'Termohon',
            'Objek',
            'Pokok Masalah',
            'Progress Penyelesaian',
            'Konseptor',
            'K1',
            'K2',
            'K3',
        ];
    }
}
