<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role_access extends Model
{
    use HasFactory;
    protected $connection='mainewash';
    protected $table='role_access';
    protected $primaryKey = 'role_access_id';
    protected $fillable=['role_access_id','role_access','role_access_menu_id','role_access_group_access_id','selected'];

    public function GroupAccess()
    {
        return $this->belongsToMany(group_access::class, 'role_access_group_access_id', 'group_access_id');
    }
    public function menu()
    {
        return $this->belongsTo(menu::class, 'role_access_menu_id', 'menu_id');
    }
}
