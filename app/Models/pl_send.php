<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pl_send extends Model
{
    use HasFactory;
    protected $connection='ewash';
    protected $table='pl_send';
    protected $primaryKey = 'id';
    protected $fillable=['tahun',
    'bulan',
    'pl',
    'style',
    'kp',
    'delivery',
    'dest','truck',
    'driver',
    'contact',
    'closing',
    'pic_closing',
    'unclose',
    'pic_unlose',
    'reason',
    'pic'];

}
