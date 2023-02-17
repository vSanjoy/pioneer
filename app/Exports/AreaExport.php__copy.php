<?php

namespace App\Exports;

use App\Models\DistributionArea;
use App\Models\Store;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;

class AreaExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents, WithTitle
{
    private $areaData;

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
            __('custom_admin.label_store'),
            __('custom_admin.label_store_phone'),
            __('custom_admin.label_beat'),
            __('custom_admin.label_category'),
            __('custom_admin.label_product'),
            __('custom_admin.label_target_monthly_sales'),
            __('custom_admin.label_total_target_completed'),
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $result = [];

        $beat = $beatId = '';
        foreach ($this->areaData as $record) {
            // Distributor
            // foreach ($record->distrubutorDetails as $distrubutor) {
            //     // dd($distrubutor);
                    

            //         $result[] = [
            //             'distribution_area'     => $record->title,
            //             'distributor'           => $distrubutor->full_name,
            //             'distributor_company'   => $distrubutor->company,
            //             'distributor_phone'     => $distrubutor->phone_no,
            //             // 'store'                 => $store,
            //             // 'store_phone'           => $storePhone,
            //             // 'beat'                  => $beat,
            //             // 'category'              => $category,
            //             // 'product'               => $product,
            //             // 'target_monthly_sales'  => $details->target_monthly_sales,
            //             // 'total_target_completed'=> $totalTargetCompleted,
            //         ];
                    
                
            // }

            foreach ($record->beatDetails as $beat) {
                // Distribution area and beat respective Stores
                $storeDetails = Store::where(['distribution_area_id' => $record->id, 'beat_id' => $beat->id])->get();
                if ($storeDetails->count()) {
                    foreach ($storeDetails as $store) {

                        $result[] = [
                                    'distribution_area'     => $record->title ?? null,
                                    'beat'                  => $beat->title ?? null,
                                    'store'                 => $store->store_name ?? null,
                                    'store_phone'           => $store->phone_no_1 ?? null,
                                    'store_owner'           => $store->name_1 ?? null,
                                    
                                    // 'category'              => $category,
                                    // 'product'               => $product,
                                    // 'target_monthly_sales'  => $details->target_monthly_sales,
                                    // 'total_target_completed'=> $totalTargetCompleted,
                                ];
                    }
                }
            }

        }

        // echo '<pre>';
        // print_r($result);
        // die('hi');

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
        return 'My Sheet';
    }

}
