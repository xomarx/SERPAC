<?php

namespace App\Models\Tesoreria;

use Illuminate\Database\Eloquent\Model;

class Egreso extends Model
{
    //
    protected $table = 'egresos';
    protected $primarykey = 'id';
    public  $timestamps=false;
    protected  $fillable = [
        'fecha','monto','descripcion','tipo_egresos_id',
        'sucursales_sucursalId','estado','motivo','persona_juridica_id','users_id'
    ];
    
    
    public function tipo_egreso()
    {
        return $this->belongsTo(Tipo_egreso::class);
    }
    
    public function sucursal ()
    {
        return $this->belongsTo(Tipo_egreso::class);
    }
    
    public function persona_juridica ()
    {
        return $this->belongsTo(Persona_juridicas::class);
    }
    
    public static function listaEgresos(){
        return \Illuminate\Support\Facades\DB::table('egresos')
                ->join('sucursales','egresos.sucursales_sucursalId','=','sucursales.sucursalId')
                ->join('tipo_egresos','egresos.tipo_egresos_id','=','tipo_egresos.id')
                ->join('users','egresos.users_id','=','users.id')
                ->where('egresos.estado','=','CANCELADO')
                ->select('egresos.fecha','tipo_egresos.tipo_egreso','sucursales.sucursal','egresos.monto','users.name','egresos.id')
                ->get();
    }
}
