<?php
/*
    * Class name    : Analyses
    * Purpose       : Table declaration
    * Author        :
    * Created Date  :
    * Modified date :
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analyses extends Model
{
    use HasFactory;

    protected $guarded = ['id'];    // The field name inside the array is not mass-assignable

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
		return $this->hasMany('App\Models\AnalysesDetail', 'analyses_id');
	}

    /*
        * Function name : analysisSeasonDetails
        * Purpose       : To get analysis season details
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
    
}