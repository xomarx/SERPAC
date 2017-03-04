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
        'fecha','monto','descripcion','tipo_egresos',
        'sucursales_sucursalId','estado','motivo'
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
}
