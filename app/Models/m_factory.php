<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class m_factory extends Model
{
    use HasFactory;
    protected $connection='mainewash';
    protected $table='m_factory';
    protected $fillable=['id','factory','db','modified','pic'];
}
