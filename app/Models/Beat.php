<?php
/*
    * Class name    : Beat
    * Purpose       : Table declaration
    * Author        : 
    * Created Date  : 
    * Modified date : 
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Beat extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];    // The field name inside the array is not mass-assignable

    /*
        * Function name : distributionAreaDetails
        * Purpose       : To get distribution area details
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
        * Function name : storeDetails
        * Purpose       : To get storeDetails
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : 
        * Return Value  : 
    */
	public function storeDetails() {
		return $this->hasOne('App\Models\Store', 'store_id');
	}
}
