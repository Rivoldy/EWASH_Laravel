<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ordersap extends Model
{
    use HasFactory;

    protected $connection='packngo_sap';
    protected $table='ordersap';
    protected $primaryKey = 'data_id';
    protected $fillable=['BSTKD','IHREZ_E','VBELN','POSNR','ZSEAS','ZMATGEN','ZMASCOL','ZCOLOR','ZSIZES','ZSETCODE','VKGRP','MAKTX','BEZEI','ZQTY','ZQTY_TOT','ZITEMCODE','ZMFC','ZBFC','ZSAMPLECODE','ZETAWH','DESTINATION','ZDESTCODE','ZWHCODE','ZDONUMBER','ZSHIPTOPORT','ZMWENG','MEINS','ERDAT','ERZET','ERNAM','ZSKUCODE','ZSHIPTOPORTC','MANDT','ZSKUCODES','crd','qtyset'];
}
