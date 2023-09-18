<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role_access extends Model
{
    use HasFactory;
    protected $connection='mainewash';
    protected $table='role_access';
    protected $fillable=['role_access_id','role_access','role_access_menu_id','role_access_group_access_id'];
}
