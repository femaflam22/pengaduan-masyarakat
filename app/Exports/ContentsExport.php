<?php

namespace App\Exports;

use App\Models\Content;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContentsExport implements FromCollection, WithCustomCsvSettings, WithHeadings
{
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }

    public function headings(): array
    {
        return ["Tanggal", "NIK", "Pengaduan", "Gambar", "Status"];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Content::select('date', 'nik', 'message', 'image', 'status')->orderBy('created_at', 'DESC')->get();
    }
}
