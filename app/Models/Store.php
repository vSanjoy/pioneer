<?php
/*
    * Class name    : Store
    * Purpose       : Table declaration
    * Author        : 
    * Created Date  : 
    * Modified date : 
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];    // The field name inside the array is not mass-assignable

    /*
        * Function name : distributionAreaDetails
        * Purpose       : To get distribution area
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : 
        * Return Value  : 
    */
	public function distributionAreaDetails() {
		return $this->belongsTo('App\Models\DistributionArea', 'distribution_area_id');
	}

    /*
        * Function name : beatDetails
        * Purpose       : To get beat
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : 
        * Return Value  : 
    */
	public function beatDetails() {
		return $this->belongsTo('App\Models\Beat', 'beat_id');
	}

    /*
        * Function name : gradeDetails
        * Purpose       : To get grade
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : 
        * Return Value  : 
    */
	public function gradeDetails() {
		return $this->belongsTo('App\Models\Grade', 'grade_id');
	}

}
