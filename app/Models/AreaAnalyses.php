<?php
/*
    * Class name    : AreaAnalyses
    * Purpose       : Table declaration
    * Author        :
    * Created Date  :
    * Modified date :
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AreaAnalyses extends Model
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
	public function seasonDetails() {
		return $this->belongsTo('App\Models\Season', 'season_id');
	}
	public function distributionAreaDetails() {
		return $this->belongsTo('App\Models\DistributionArea', 'distribution_area_id');
	}
	public function distributorDetails() {
		return $this->belongsTo('App\Models\User', 'distributor_id');
	}
    public function storeDetails() {
        return $this->belongsTo('App\Models\Store', 'store_id');
    }
    public function categoryDetails() {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function productDetails() {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }


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