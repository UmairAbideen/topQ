<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\Feedback;

class ExportFeedbackExcel implements FromView, WithStyles
{
    public function view(): View
    {
        return view('qa.feedback.export.export', [
            'feedbacks' => Feedback::all()
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        // Get dynamic range
        $highestRow = $sheet->getHighestRow(); // e.g., 55
        $highestColumn = $sheet->getHighestColumn(); // e.g., 'E'
        $range = "A1:{$highestColumn}{$highestRow}";

        // Apply styling to full range
        $sheet->getStyle($range)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'wrapText' => false,
            ],
        ]);

        // Optional: make first row bold (header)
        $sheet->getStyle("A1:{$highestColumn}1")->getFont()->setBold(true);

        return [];
    }
}
