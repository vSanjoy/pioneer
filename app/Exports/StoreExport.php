<?php

namespace App\Exports;

use App\Models\Store;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class StoreExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    private $storeData;

    public function __construct($data) {
        $this->storeData = $data;
    }

    public function headings(): array
    {
        return [
            __('custom_admin.label_store'),
            __('custom_admin.label_store_phone'),
            __('custom_admin.label_store_owner'),
            __('custom_admin.label_distribution_area'),
            __('custom_admin.label_beat')
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $result = [];

        $distributionArea = $beat = '';
        foreach ($this->storeData as $record) {
            if ($record) {
                if ($record->distributionAreaDetails !== NULL) {
                    $distributionArea = $record->distributionAreaDetails->title ?? '';
                }
                if ($record->beatDetails !== NULL) {
                    $beat   = $record->beatDetails->title ?? '';
                }

                $result[] = [
                    'store'                 => $record->store_name,
                    'store_phone'           => $record->phone_no_1,
                    'store_owner'           => $record->name_1,
                    'distribution_area'     => $distributionArea,
                    'beat'                  => $beat,
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

}
