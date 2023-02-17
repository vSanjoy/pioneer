<?php

namespace App\Exports;

use App\Models\User;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;


class DistributorExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents, WithTitle
{
    public function __construct($data) {
        $this->areaData = $data;
    }

    public function headings(): array
    {
        return [
            __('custom_admin.label_distribution_area'),
            __('custom_admin.label_distributor'),
            __('custom_admin.label_distributor_company'),
            __('custom_admin.label_distributor_phone'),
        ];
    }

    public function collection()
    {
        $result = [];

        foreach ($this->areaData as $record) {
            // Distributor
            foreach ($record->distrubutorDetails as $distrubutor) {
                $result[] = [
                    'distribution_area'     => $record->title,
                    'distributor'           => $distrubutor->full_name,
                    'distributor_company'   => $distrubutor->company,
                    'distributor_phone'     => $distrubutor->phone_no,
                ];
            }
        }
        return collect($result);
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:Z1';   // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(13);
            },
        ];
    }

    public function title(): string
    {
        return 'Distributor';
    }

}
