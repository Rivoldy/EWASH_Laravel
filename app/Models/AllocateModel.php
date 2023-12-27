<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllocateModel extends Model
{
    use HasFactory;
    protected $connection='ewash';
    protected $table='wash_transaction';
    protected $primaryKey = 'id';
    protected $fillable=['wid','kp','color','size','qty','pack','addi','pic'];
}
