<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mgramasi extends Model
{
    use HasFactory;

    protected $connection='ewash';
    protected $table='m_gramasi';
    protected $fillable=['g_style','g_size','g_val','createby'];
}
