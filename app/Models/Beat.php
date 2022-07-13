<?php
/*
    * Class name    : Beat
    * Purpose       : Table declaration
    * Author        : 
    * Created Date  : 
    * Modified date : 
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Beat extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];    // The field name inside the array is not mass-assignable

    /*
        * Function name : storeDetails
        * Purpose       : To get storeDetails
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : 
        * Return Value  : 
    */
	public function storeDetails() {
		return $this->hasOne('App\Models\Store', 'beat_id');
	}
}
