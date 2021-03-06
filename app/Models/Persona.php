<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Persona extends Model
{
    //
    protected $table = 'personas';
    protected $primarykey = 'dni';
    public  $timestamps=false;
    protected  $fillable = [
        'dni','paterno','materno','nombre',
        'fec_nac','sexo','direccion','telefono','comites_locales_id'
    ];    
    /**
     * Devuelve el socio propietario de esta persona
     */
    public function socio()
    {
        return $this->belongsTo(Socios\socio::class);
    }
    
    public function empleado()
    {
        return $this->belongsTo(RRHH\Empleado::class);
    }
    
    public function pariente()
    {
        return $this->belongsTo(Socios\Pariente::class);
    }
    
    public function transferenciaantiguo()
    {
        return $this->hasOne(Socios\Transferencia::class);
    }
    
    
    public function transferencianueva()
    {
        return $this->hasOne(Socios\Transferencia::class);
    }


    public function  comites_locale()
    {
        return $this->belongsTo(Socios\Comites_Locale::class);
    }
    
    public static function scopeDNIPersonas($query,$dni){
        return $query
                ->where('dni','=',$dni)
                ->select('paterno','materno','nombre','dni','direccion')
                ->first();
    }


    public static function scopedniParientesSocios($query,$dni)
    {
      return $socio = $query
              ->join('parientes','personas.dni','=','parientes.personas_dni')
              ->join('comites_locales','personas.comites_locales_id','=','comites_locales.id')
              ->where ('personas.dni','like','%'.$dni.'%')
              ->select('personas.paterno','personas.materno','personas.nombre','personas.fec_nac'
                      ,'comites_locales.comite_local','personas.dni')
              ->take(7)->get();
    }
    
    public static function scopeAutodniPersonas($query,$dni)
    {
      return $query             
              ->join('comites_locales','personas.comites_locales_id','=','comites_locales.id')
              ->where ('personas.dni','like','%'.$dni.'%')
              ->select('personas.paterno','personas.materno','personas.nombre','personas.fec_nac'
                      ,'comites_locales.comite_local','personas.dni')
              ->take(7)->get();
    }
    
    public static function scopeautoDatosPersonas($query,$dato){
        return $query
                ->where (DB::raw("concat(paterno,' ',materno,' ',nombre)"),'like','%'.$dato.'%')
              ->select('paterno','materno','nombre','fec_nac'
                     ,'dni')
              ->take(7)->get();
    }
    
    public static function scopeListAcopiador($query){
        return $query
                ->leftJoin('sucursales','dni','=','personas_dni')
                ->select(DB::raw("concat(paterno, ' ', materno,' ',nombre) as acopiador"),'dni')
                ->get();
    }
    
    public static function scopeautocompleteDNInoEmpleado($query,$dni){
        $parientes = DB::table('personas')->join('parientes','dni','=','personas_dni')
                ->where('personas_dni','like','%'.$dni.'%')
                ->select('personas.dni',  DB::raw("concat(paterno,' ',materno,' ',nombre) as datos"))
                ;
        $socios = DB::table('personas')
                ->join('socios','personas.dni','=','socios.dni')
                ->where('socios.dni','like','%'.$dni.'%')
                ->select('socios.dni',  DB::raw("concat(paterno,' ',materno,' ',nombre) as datos"))
                ->union($parientes)
                ->take(7)->get();
        return $socios;
    }
    
    public static function scopeautoDatosNoEmpleados($query,$dato){
        $parientes = DB::table('personas')->join('parientes','dni','=','personas_dni')
                ->where(DB::raw("concat(paterno,' ',materno,' ',nombre)"),'like','%'.$dato.'%')
                ->select('personas.dni',  DB::raw("concat(paterno,' ',materno,' ',nombre) as datos"))
                ;
        $socios = DB::table('personas')
                ->join('socios','personas.dni','=','socios.dni')
                ->where(DB::raw("concat(paterno,' ',materno,' ',nombre)"),'like','%'.$dato.'%')
                ->select('socios.dni',  DB::raw("concat(paterno,' ',materno,' ',nombre) as datos"))
                ->union($parientes)
                ->take(7)->get();
        return $socios;
    }

    

    public static function getdatonuevosocio($dni)
    {
        return DB::table('personas')
                ->join('parientes','personas.dni','=','parientes.personas_dni')
                ->join('comites_locales','personas.comites_locales_id','=','comites_locales.id')
                ->where('parientes.personas_dni','=',$dni)
                ->select('personas.nombre','personas.paterno','personas.materno','personas.dni'
                        ,'personas.fec_nac','comites_locales.comite_local')
                ->first();
    }
            
    public static function getdatopersona($dni)
    {
        return DB::table('personas')                
                ->join('comites_locales','personas.comites_locales_id','=','comites_locales.id')
                ->join('comites_centrales','comites_locales.comites_centrales_id','=','comites_centrales.id')
                ->where('personas.dni','=',$dni)
                ->select('personas.nombre','personas.paterno','personas.materno','personas.dni'
                        ,'personas.fec_nac','comites_locales.comite_local','comites_centrales.comite_central')
                ->first();
    }
    
    public static function getdatoBeneficiario($dni)
    {
        return DB::table('personas')                
                ->join('comites_locales','personas.comites_locales_id','=','comites_locales.id')
                ->where('personas.dni','=',$dni)
                ->select('personas.nombre','personas.paterno','personas.materno','personas.dni'
                        ,'personas.fec_nac','comites_locales.comite_local')
                ->first();
    }
    
    
};
