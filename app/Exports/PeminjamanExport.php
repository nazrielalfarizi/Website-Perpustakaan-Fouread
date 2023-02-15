<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PeminjamanExport implements FromView, WithMapping, WithColumnWidths, WithStyles{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function view(): View
    {
        $peminjamen = Peminjaman::with('user', 'buku')->get();

        return view('export.peminjaman', [
            'peminjamen' => $peminjamen
        ]);
    }

    public function map($peminjaman): array
    {
        $this->no++;

        return [
            $this->no,
            $peminjaman->buku->judul,
            $peminjaman->user->name,
            $peminjaman->arsip,
            $peminjaman->status,
            $peminjaman->tanggal
        ];
    }

    public function headings(): array
    {
        return[
            'NO',
            'Judul Buku',
            'Nama Siswa',
            'Jumlah Peminjaman',
            'Status',
            'Harus Dikembalikan'
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 45,
            'C' => 25,
            'D' => 25,
            'E' => 25,
            'F' => 25
        ];
    }

    public function exportexcel()
    {
        return Excel::download(new PeminjamanExport, 'data-peminjaman.xlsx');
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('1')->getFont()->setBold(true);
        $sheet->getStyle('1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('D')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('E')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    }

}