<?php

namespace App\Models\Tesoreria;

use Illuminate\Database\Eloquent\Model;

class Persona_juridicas extends Model
{
    //
    protected $table = 'persona_juridicas';
    protected $primarykey = 'id';
    public  $timestamps=false;
    protected  $fillable = [
        'ruc','razon_social','telefono','direccion'        
    ];
    
    public static  function egresos()
    {
        return $this->hasMany(Egreso::class);
    }
}
