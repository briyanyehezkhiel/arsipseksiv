<?php

namespace App\Imports;

use App\Models\PN;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PNImport implements ToCollection, WithStartRow
{
    protected $tahun;
    protected $timestamp;

    // Menerima tahun dari form input
    public function __construct($tahun)
    {
        $this->tahun = $tahun;
        $this->timestamp = now();
    }

     /**
     * Mengatur baris pertama yang digunakan untuk membaca data.
     *
     * @return int
     */
    public function startRow(): int
    {
        return 4; // Mulai membaca dari baris ke-2 untuk mengambil data
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {

        $firstRow = $rows->first();

        // Validasi: Tahun diisi manual dan file juga punya tahun
        if (
            $this->tahun &&
            (
                isset($firstRow[0]) &&
                is_numeric($firstRow[0]) &&
                strlen($firstRow[0]) == 4
            )
        ) {
            throw new \Exception("Gagal import: Anda mengisi tahun manual dan file juga mengandung kolom tahun. Harap pilih salah satu.");
        }
        // Validasi: Tahun tidak diisi dan file tidak mengandung kolom tahun
        else if (
            !$this->tahun &&
            (
                !isset($firstRow[0]) ||
                !is_numeric($firstRow[0]) ||
                strlen($firstRow[0]) != 4
            )
        ) {
            throw new \Exception("Gagal import: Tahun tidak diisi dan file tidak mengandung kolom tahun yang valid (4 digit). Harap pilih salah satu.");
        }

        // Validasi: File kosong
        else if ($rows->isEmpty()) {
            throw new \Exception("Gagal import: File CSV kosong.");
        }
        // Validasi: file tidak sesuai
        // else {
        //     throw new \Exception("Gagal import: File tidak sesuai");
        // }


        foreach ($rows->reverse() as $row) {
            PN::create([
            'tahun' =>  $this->tahun ?? $row[0],  // Gunakan tahun dari form input
            'no_register_perkara' => $row[1] ?? null,
            'penggugat' => $row[2] ?? null,
            'tergugat' => $row[3] ?? null,
            'objek_perkara' => $row[4] ?? null,
            'tk1' => isset($row[5]) ? (bool) $row[5] : null,
            'banding' => isset($row[6]) ? (bool) $row[6] : null,
            'kasasi' => isset($row[7]) ? (bool) $row[7] : null,
            'pk' => isset($row[8]) ? (bool) $row[8] : null,
            'tipologi_kasus' => $row[9] ?? null,
            'menang' => isset($row[10]) ? (bool) $row[10] : null,
            'kalah' => isset($row[11]) ? (bool) $row[11] : null,
            'keterangan' => $row[12] ?? null,
            'justicia' => $row[13] ?? null,
            'created_at' => $this->timestamp,
            'updated_at' => $this->timestamp,


        ]);
    }
}
}
