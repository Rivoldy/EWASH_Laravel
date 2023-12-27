<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class t_bag extends Model
{
    use HasFactory;
    protected $connection='ewash';
    protected $table='t_bag';
    protected $primaryKey ='id';
    protected $fillable=['bid','digunakan','workshop','style','kp','wh','color','size','qty','pl_id','loading','pic_loading','closing_status','closing','pic'];
}
