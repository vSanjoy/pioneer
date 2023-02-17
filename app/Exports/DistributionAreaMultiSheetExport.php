<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DistributionAreaMultiSheetExport implements WithMultipleSheets
{
    private $areaData;

    public function __construct($data) {
        $this->areaData = $data;
    }

    public function sheets(): array 
    {
        $sheets = [
            'Store'         =>  new AreaExport($this->areaData),
            'Distributor'   =>  new DistributorExport($this->areaData),
            'Representative'=>  new RepresentativeExport($this->areaData)
          ];

        return $sheets;
    }
}
