<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    use HasFactory;
    protected $connection='mainewash';
    protected $table='menu';
    protected $fillable=['menu_id','menu_name','menu_is_active','menu_system_id'];
}
