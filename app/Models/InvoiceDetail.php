<?php
/*
    * Class name    : InvoiceDetail
    * Purpose       : Table declaration
    * Author        :
    * Created Date  :
    * Modified date :
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];    // The field name inside the array is not mass-assignable

    /*
        * Function name : invoice
        * Purpose       : To get single step order details
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
        * Function name : categoryDetails
        * Purpose       : To get category details
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
        * Purpose       : To get product details
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