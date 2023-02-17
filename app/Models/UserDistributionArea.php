<?php
/*
    * Class name    : UserDistributionArea
    * Purpose       : Table declaration
    * Author        :
    * Created Date  :
    * Modified date :
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDistributionArea extends Model
{
    public $timestamps = false;

    /*
        * Function name : representativeDetails
        * Purpose       : To get representative details
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : 
        * Return Value  : 
    */
    public function representativeDetails() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}