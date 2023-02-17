<?php

namespace App\Exports;

use App\Models\Analyses;
use App\Models\SingleStepOrder;
use App\Models\SingleStepOrderDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class AnalysisExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    private $analysisData;

    public function __construct($data) {
        $this->analysisData = $data;
    }

    public function headings(): array
    {
        return [
            __('custom_admin.label_date'),
            __('custom_admin.label_analysis_season'),
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
        foreach ($this->analysisData as $record) {
            $analysisSeason = $distributionArea = $distributor = $distributorCompany = $distributorPhone = $store = $storePhone = $beat = '';
            if ($record->analysisSeasonDetails !== NULL) {
                $analysisSeason = $record->analysisSeasonDetails->title ?? '';
            }
            if ($record->distributionAreaDetails !== NULL) {
                $distributionArea = $record->distributionAreaDetails->title ?? '';
            }
            if ($record->distributorDetails !== NULL) {
                $distributor = $record->distributorDetails->full_name ?? '';
                $distributorCompany = $record->distributorDetails->company;
                $distributorPhone = $record->distributorDetails->phone_no;
            }
            if ($record->storeDetails !== NULL) {
                $store = $record->storeDetails->store_name ?? '';
                $storePhone = $record->storeDetails->phone_no_1;
            }
            // Beat
            // if ($record->beatDetails !== NULL) {
            //     if ($beatId != $record->beat_id) {
            //         $beatId = $record->beat_id;
            //         $beat   = $record->beatDetails->title ?? '';
            //     } else {
            //         $beat   = '';
            //     }
            // }
            if ($record->beatDetails !== NULL) {
                $beat   = $record->beatDetails->title ?? '';
            }

            $category = $product = $categoryId = '';
            foreach ($record->analysesDetails as $details) {
                if ($details) {
                    // Category
                    // if ($details->categoryDetails !== NULL) {
                    //     if ($categoryId != $details->category_id) {
                    //         $categoryId = $details->category_id;
                    //         $category   = $details->categoryDetails->title ?? '';
                    //     } else {
                    //         $category   = '';
                    //     }
                    // }
                    if ($details->categoryDetails !== NULL) {
                        $category = $details->categoryDetails->title ?? '';
                    }
                    if ($details->productDetails !== NULL) {
                        $product = $details->productDetails->title ?? '';
                    }

                    $singleStepOrders = SingleStepOrder::where([
                                                                'analysis_season_id'    => $record->analysis_season_id,
                                                                'distribution_area_id'  => $record->distribution_area_id,
                                                                'distributor_id'        => $record->distributor_id,
                                                                'beat_id'               => $record->beat_id,
                                                                'store_id'              => $record->store_id
                                                                ])
                                                                ->orderBy('analysis_date', 'DESC')
                                                                ->get();

                    $totalTargetCompleted = '0';
                    if ($singleStepOrders->count()) {
                        foreach ($singleStepOrders as $order) {
                            $singleStepOrderDetails = SingleStepOrderDetail::where([
                                                                                    'single_step_order_id'  => $order->id,
                                                                                    'category_id'           => $details->category_id,
                                                                                    'product_id'            => $details->product_id,
                                                                                ])->get();
                            if ($singleStepOrderDetails->count()) {
                                foreach ($singleStepOrderDetails as $orderDetails) {
                                    if ( is_numeric($orderDetails->qty) ) {
                                        $totalTargetCompleted += $orderDetails->qty;
                                    }
                                }
                            }
                        }
                    }

                    // $result[] = [
                    //     'date'                  => changeDateFormat($record->analysis_date),
                    //     'analysis_season'       => $analysisSeason.'---'.$record->analysis_season_id,
                    //     'distribution_area'     => $distributionArea.'---'.$record->distribution_area_id,
                    //     'distributor'           => $distributor.'---'.$record->distributor_id,
                    //     'distributor_company'   => $distributorCompany,
                    //     'distributor_phone'     => $distributorPhone,
                    //     'store'                 => $store.'---'.$record->store_id,
                    //     'store_phone'           => $storePhone,
                    //     'beat'                  => $beat.'---'.$record->beat_id,
                    //     'category'              => $category.'---'.$details->category_id,
                    //     'product'               => $product.'---'.$details->product_id,
                    //     'target_monthly_sales'  => $details->target_monthly_sales,
                    //     // 'single_step_order'     => $singleStepOrders,
                    //     'total'                 => $totalTargetCompleted,
                    // ];

                    $result[] = [
                        'date'                  => changeDateFormat($record->analysis_date),
                        'analysis_season'       => $analysisSeason,
                        'distribution_area'     => $distributionArea,
                        'distributor'           => $distributor,
                        'distributor_company'   => $distributorCompany,
                        'distributor_phone'     => $distributorPhone,
                        'store'                 => $store,
                        'store_phone'           => $storePhone,
                        'beat'                  => $beat,
                        'category'              => $category,
                        'product'               => $product,
                        'target_monthly_sales'  => $details->target_monthly_sales,
                        'total_target_completed'=> $totalTargetCompleted,
                    ];
                }
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
