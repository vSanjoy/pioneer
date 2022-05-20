<?php
/*
    * Class name    : AreaAnalysis
    * Purpose       : Table declaration
    * Author        :
    * Created Date  :
    * Modified date :
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AreaAnalysis extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];    // The field name inside the array is not mass-assignable

	/*
        * Function name : areaAnalysisDetails
        * Purpose       : To get area analysis details
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : 
        * Return Value  : 
    */
	public function areaAnalysisDetails() {
		return $this->hasMany('App\Models\AreaAnalysisDetail', 'area_analysis_id');
	}
    
}