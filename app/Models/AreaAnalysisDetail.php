<?php
/*
    * Class name    : AreaAnalysisDetail
    * Purpose       : Table declaration
    * Author        :
    * Created Date  :
    * Modified date :
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AreaAnalysisDetail extends Model
{
	use HasFactory, SoftDeletes;

    protected $guarded = ['id'];    // The field name inside the array is not mass-assignable

	/*
        * Function name : areaAnalyses
        * Purpose       : To get area analyses
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : 
        * Return Value  : 
    */
  	public function areaAnalyses() {
		return $this->belongsTo('App\Models\AreaAnalyses', 'area_analysis_id');
	}
}