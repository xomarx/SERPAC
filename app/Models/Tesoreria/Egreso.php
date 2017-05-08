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
        'fecha','monto','concepto','comprobante',
        'sucursales_sucursalId','estado','num_comprobante','persona_juridica_id','users_id'
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
    
    public static function scopelistaEgresos($query){
        return $query
                ->join('sucursales','egresos.sucursales_sucursalId','=','sucursales.sucursalId')                
                ->join('users','egresos.users_id','=','users.id')
                ->where('egresos.estado','=',0)
                ->select('egresos.fecha','concepto','comprobante','num_comprobante','sucursales.sucursal','monto','users.name','egresos.id')
                ->get();
    }
}
