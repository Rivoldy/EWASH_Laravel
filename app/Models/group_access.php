<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class group_access extends Model
{
    use HasFactory;
    protected $connection='mainewash';
    protected $table='group_access';
    protected $primaryKey = 'group_access_id';
    protected $fillable=['group_access_id','group_access_name'];

    public function roleAccess()
    {
        return $this->hasMany(role_access::class, 'role_access_group_access_id', 'group_access_id');
    }
    public function privilege()
    {
        return $this->hasMany(privilege::class, 'privilege_id', 'group_access_id');
    }
    public function privSambi()
    {
        return $this->hasMany(PrivSambi::class, 'privilege_id', 'group_access_id');
    }
    public function menus()
    {
    return $this->belongsToMany(Menu::class, 'role_access', 'role_access_group_access_id', 'role_access_menu_id')
        ->withPivot('role_access');
    }
}
