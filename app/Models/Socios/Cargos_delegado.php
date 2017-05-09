<?php

namespace App\Models\Socios;

use Illuminate\Database\Eloquent\Model;

class Cargos_delegado extends Model
{
    //
    protected  $table = 'cargos_delegados';
    protected  $increment = 'id';
    public  $timestamps=false;
    protected  $fillable  = [
        'cargo_delegado'
        ];
    
    public function personas(){
        return $this->belongsToMany(\App\Models\Persona::class);
    }


    public static function scopelistaAsignacionDelegados($query,$dato){
            return $query 
                    ->join('cargos_delegados_has_socios','cargos_delegados_id','=','cargos_delegados.id')
                    ->join('personas','personas_dni','=','dni')
                    ->where(function($query)use($dato){
                        $query
                                ->where('dni','like','%'.$dato.'%')
                                ->orwhere('fecha_inicio','like','%'.$dato.'%')
                                ->orwhere('fecha_final','like','%'.$dato.'%')
                                ->orwhere('cargo_delegado','like','%'.$dato.'%')
                                ->orwhere('estado','like','%'.$dato.'%')
                                ->orwhere(\Illuminate\Support\Facades\DB::raw("concat(paterno,' ' ,materno,' ',nombre)"),'like','%'.$dato.'%');
                    })
                    ->select('dni','fecha_inicio','fecha_final','cargo_delegado','estado','cargos_delegados_has_socios.id',
                            \Illuminate\Support\Facades\DB::raw("concat(paterno,' ' ,materno,' ',nombre) as datos"))->paginate(10);
        }
        
        public function scopegetAsigDelegado($query,$id){
            return $query 
                    ->join('cargos_delegados_has_socios','cargos_delegados_id','=','cargos_delegados.id')
                    ->join('personas','personas_dni','=','dni')
                    ->where('cargos_delegados_has_socios.id','=',$id)
                    ->select('dni','fecha_inicio','fecha_final','cargos_delegados_id','estado',
                            \Illuminate\Support\Facades\DB::raw("concat(paterno,' ' ,materno,' ',nombre) as datos"))->first();
        }
}
