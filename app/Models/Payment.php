<?php
/*
    * Class name    : Payment
    * Purpose       : Table declaration
    * Author        :
    * Created Date  :
    * Modified date :
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];    // The field name inside the array is not mass-assignable

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
        * Purpose       : To get store details
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
        * Function name : singleStepOrder
        * Purpose       : To get single step order
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : 
        * Return Value  : 
    */
	public function singleStepOrder() {
		return $this->belongsTo('App\Models\SingleStepOrder', 'single_step_order_id');
	}

    /*
        * Function name : invoice
        * Purpose       : To get invoice
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : 
        * Return Value  : 
    */
    public function invoice() {
        return $this->belongsTo('App\Models\Invoice', 'invoice_id');
    }

    /*
        * Function name : paymentDetails
        * Purpose       : To get payment details
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : 
        * Return Value  : 
    */
	public function paymentDetails() {
		return $this->hasMany('App\Models\PaymentDetail', 'payment_id');
	}
    
}