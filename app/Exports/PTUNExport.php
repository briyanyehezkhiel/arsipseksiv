<?php

namespace App\Exports;

use App\Models\PTUN;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class PTUNExport implements FromCollection, WithHeadings, WithCustomStartCell
{

    public function startCell(): string
    {
        return 'A3'; // data mulai dari A4 (baris ke-4)
    }

    public function collection()
    {
        return PTUN::select(
            'tahun',
            'lokus_dan_register_perkara',
            'penggugat',
            'tergugat',
            'objek_perkara_letak',
            'tk1',
            'banding',
            'kasasi',
            'pk',
            'amar_putusan_akhir',
            'keterangan'
        )
        ->orderBy('id', 'desc') 
        ->get();
    }

    public function headings(): array
    {
        return [
            'Tahun',
            'Lokus dan Register Perkara',
            'Penggugat',
            'Tergugat',
            'Objek Perkara / Letak',
            'TK1',
            'Banding',
            'Kasasi',
            'PK',
            'Amar Putusan Akhir',
            'Keterangan',
        ];
    }


}

