<?php

namespace App\Models\Socios;

use Illuminate\Database\Eloquent\Model;

class Condicions_has_socio extends Model
{
    //
    public  $timestamps=false;
     protected  $fillable = [
        'condicions_id','socios_codigo'];
}
