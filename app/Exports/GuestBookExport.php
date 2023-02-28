<?php

namespace App\Exports;

use App\Models\GuestBook;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GuestBookExport implements FromView, WithMapping, WithColumnWidths, WithStyles{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function view(): View
    {
        $guestbook = GuestBook::with('user', 'kelas')->get();

        return view('export.guestbook', [
            'guestbook' => $guestbook
        ]);
    }

    public function map($guestbooks): array
    {
        $this->no++;

        return [
            $this->no,
            $guestbooks->user->name,
            $guestbooks->kelas->nama,
            $guestbooks->tanggal,
            $guestbooks->tujuan
        ];
    }

    public function headings(): array
    {
        return[
            'NO',
            'Nama Siswa',
            'Kelas',
            'Tanggal',
            'Tujuan'
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
        ];
    }

    public function exportexcel()
    { 
        return Excel::download(new GuestBookExport, 'data-tamu.xlsx');
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