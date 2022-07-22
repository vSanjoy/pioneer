<?php
/*
    * Class name    : Order
    * Purpose       : Table declaration
    * Author        :
    * Created Date  :
    * Modified date :
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];    // The field name inside the array is not mass-assignable

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