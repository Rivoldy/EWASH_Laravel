<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class t_scale extends Model
{
    use HasFactory;
    
    protected $connection='ewash';
    protected $table='t_scale';
    protected $primaryKey = 'id';
    protected $fillable=['bid','style','kp','color','size','qty','gramasi','gw','nw','tolerance','empty','digunakan','workshop','pl_id','loading','pic_loading','closing_status','closing','pic'];

}