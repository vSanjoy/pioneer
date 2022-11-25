<?php
/*
    * Class name    : SingleStepOrder
    * Purpose       : Table declaration
    * Author        :
    * Created Date  :
    * Modified date :
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SingleStepOrder extends Model
{
    use HasFactory;

    protected $guarded = ['id'];    // The field name inside the array is not mass-assignable

    /*
        * Function name : analysisSeasonDetails
        * Purpose       : To get distribution area
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : 
        * Return Value  : 
    */
	public function analysisSeasonDetails() {
		return $this->belongsTo('App\Models\AnalysisSeason', 'analysis_season_id');
	}

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
        * Function name : distributorDetails
        * Purpose       : To get distributor details
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : 
        * Return Value  : 
    */
	public function distributorDetails() {
		return $this->belongsTo('App\Models\User', 'distributor_id');
	}

    /*
        * Function name : sellerDetails
        * Purpose       : To get seller details
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : 
        * Return Value  : 
    */
	public function sellerDetails() {
		return $this->belongsTo('App\Models\User', 'seller_id');
	}

    /*
        * Function name : beatDetails
        * Purpose       : To get beat details
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
        * Function name : storeDetails
        * Purpose       : To get store
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : 
        * Return Value  : 
    */
	public function storeDetails() {
		return $this->belongsTo('App\Models\Store', 'store_id');
	}

    /*
        * Function name : analysesDetails
        * Purpose       : To get analyses details
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : 
        * Return Value  : 
    */
	public function analysesDetails() {
		return $this->belongsTo('App\Models\AnalysesDetail', 'analyses_id');
	}

    /*
        * Function name : singleStepOrderDetails
        * Purpose       : To get order details
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : 
        * Return Value  : 
    */
	public function singleStepOrderDetails() {
		return $this->hasMany('App\Models\SingleStepOrderDetail', 'single_step_order_id');
	}
    
}