<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class group_access extends Model
{
    use HasFactory;
    protected $connection='mainewash';
    protected $table='group_access';
    protected $fillable=['group_access_id','group_access_name'];
}
