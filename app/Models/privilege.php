<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class privilege extends Model
{
    use HasFactory;
    protected $connection='ewash';
    protected $table='privilege';
    protected $primaryKey ='privilege_id';
    protected $fillable=['privilege_id','privilege_user_nik','privilege_user_name','privilege_group_access_id','privilege_group_access_mobile','privilege_rfid','privilege_aktif'];
    
    public function groupAccess()
    {
        return $this->belongsToMany(group_access::class, 'privilege_id', 'group_access_id');
    }

}
