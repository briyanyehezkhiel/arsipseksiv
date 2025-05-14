<?php

namespace App\Imports;

use App\Models\PTUN;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;


class PTUNImport implements ToCollection, WithStartRow
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
            PTUN::create([
            'tahun' =>  $this->tahun ?? $row[0],  // Gunakan tahun dari form input
            'lokus_dan_register_perkara' => $row[1] ?? null, // Lokasi dan register perkara, misalnya B2
            'penggugat' => $row[2] ?? null, // Penggugat, misalnya C3
            'tergugat' => $row[3] ?? null, // Tergugat, misalnya D3
            'objek_perkara_letak' => $row[4] ?? null, // Objek perkara, misalnya E2
            'tk1' => $row[5] ?? null, // TK1, misalnya F3
            'banding' => $row[6] ?? null, // Banding, misalnya G3
            'kasasi' => $row[7] ?? null, // Kasasi, misalnya H3
            'pk' => $row[8] ?? null, // Peninjauan Kembali, misalnya I3
            'amar_putusan_akhir' => $row[9] ?? null, // Amar Putusan Terakhir, misalnya J2
            'keterangan' => $row[10] ?? null, // Keterangan, misalnya K2
            'created_at' => $this->timestamp,
            'updated_at' => $this->timestamp,
        ]);
    }
}
}
