<?php

namespace App\Models\Socios;

use Illuminate\Database\Eloquent\Model;

class Cargos_delegados_has_socios extends Model
{
    //
    public  $timestamps=false;
    protected  $fillable  = [
        'cargos_delegados_id','personas_dni','fecha_inicio','fecha_final','estado'
        ];
}
