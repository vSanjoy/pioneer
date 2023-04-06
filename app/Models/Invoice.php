<?php
/*
    * Class name    : Invoice
    * Purpose       : Table declaration
    * Author        :
    * Created Date  :
    * Modified date :
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

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
	public function singleStepOrder() {
		return $this->belongsTo('App\Models\SingleStepOrder', 'single_step_order_id');
	}

    /*
        * Function name : invoiceDetails
        * Purpose       : To get invoice details
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : 
        * Return Value  : 
    */
	public function invoiceDetails() {
		return $this->hasMany('App\Models\InvoiceDetail', 'invoice_id');
	}
    
}