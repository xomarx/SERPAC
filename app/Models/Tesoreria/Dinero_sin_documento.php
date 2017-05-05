<?php

namespace App\Models\Tesoreria;

use Illuminate\Database\Eloquent\Model;

class Dinero_sin_documento extends Model
{
    //
    protected  $fillable = [
        'fecha','monto','detalle','tipoGasto',
        'estado','users_id','empleados_empleadoId'
    ];
    
    public function mov_dineros(){
        return $this->belongsToMany(Mov_dinero::class);
    }
    
    
    public static function scopelistaSD($query){
        return  $query
                ->join('empleados','empleados_empleadoId','=','empleadoId')
                ->join('personas','personas_dni','=','dni')
                ->join('users','users_id','=','users.id')
                ->select('dinero_sin_documentos.id','fecha','detalle','monto','tipoGasto','dinero_sin_documentos.estado','name',  \Illuminate\Support\Facades\DB::raw("concat(paterno,' ',materno,' ',nombre) as empleado"))->get();
    }
}
