<?php
/*
    * Class name    : DistributionArea
    * Purpose       : Table declaration
    * Author        : 
    * Created Date  : 
    * Modified date : 
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DistributionArea extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];    // The field name inside the array is not mass-assignable

    /*
        * Function name : distrubutorDetails
        * Purpose       : To get distributor details
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : 
        * Return Value  : 
    */
    public function distrubutorDetails() {
        return $this->hasMany('App\Models\User', 'distribution_area_id');
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
        return $this->hasMany('App\Models\Beat', 'distribution_area_id');
    }

    /*
        * Function name : representativeDistributionAreaDetails
        * Purpose       : To get user distribution area details
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : 
        * Return Value  : 
    */
    public function representativeDistributionAreaDetails()
    {
        return $this->hasMany('App\Models\UserDistributionArea');
    }

}
