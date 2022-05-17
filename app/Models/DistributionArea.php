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

}
