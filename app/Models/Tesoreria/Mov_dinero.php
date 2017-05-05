<?php

namespace App\Models\Tesoreria;

use Illuminate\Database\Eloquent\Model;

class Mov_dinero extends Model
{
    //
    protected  $fillable = [
        'fecha','monto','detalle','tipoGasto',
        'estado','users_id','empleados_empleadoId'
    ];
    public function dinero_sin_documentos(){
        return $this->belongsToMany(Dinero_sin_documento::class);
    }
}
