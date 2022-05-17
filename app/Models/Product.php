<?php
/*
    * Class name    : Product
    * Purpose       : Table declaration
    * Author        : 
    * Created Date  : 
    * Modified date : 
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];    // The field name inside the array is not mass-assignable

    /*
        * Function name : categoryDetails
        * Purpose       : To get category
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : 
        * Return Value  : 
    */
	public function categoryDetails() {
		return $this->belongsTo('App\Models\Category', 'category_id');
	}

}
