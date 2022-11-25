<?php
/*
    * Class name    : SingleStepOrderDetail
    * Purpose       : Table declaration
    * Author        :
    * Created Date  :
    * Modified date :
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SingleStepOrderDetail extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = ['id'];    // The field name inside the array is not mass-assignable

    /*
        * Function name : singleStepOrderDetails
        * Purpose       : To get single step order details
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : 
        * Return Value  : 
    */
	public function singleStepOrderDetails() {
		return $this->belongsTo('App\Models\SingleStepOrder', 'single_step_order_id');
	}
    
    /*
        * Function name : categoryDetails
        * Purpose       : To get store details
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : 
        * Return Value  : 
    */
	public function categoryDetails() {
		return $this->belongsTo('App\Models\Category', 'category_id');
	}

    /*
        * Function name : productDetails
        * Purpose       : To get product
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : 
        * Return Value  : 
    */
	public function productDetails() {
		return $this->belongsTo('App\Models\Product', 'product_id');
	}    
}