<?php
/*
    * Class name    : RolePermission
    * Purpose       : Table declaration
    * Author        :
    * Created Date  :
    * Modified date :
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
	public $timestamps = false;

	/*
        * Function name : page
        * Purpose       : To get role page details
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : 
        * Return Value  : 
    */
  	public function page() {
		return $this->belongsTo('App\Models\RolePage', 'page_id');
	}
}