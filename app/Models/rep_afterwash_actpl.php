<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rep_afterwash_actpl extends Model
{
    use HasFactory;
    protected $connection='ewash';
    protected $table='';
    protected $primaryKey ='';
    protected $fillable=['','_user_nik','_user_name','_group_access','_group_access_mobile','_rfid','_active'];
}
