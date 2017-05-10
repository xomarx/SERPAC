<?php

namespace App\Models\Socios;

use Illuminate\Database\Eloquent\Model;

class Cargos_directivo extends Model
{
    //
    protected  $table = 'cargos_directivos';
    protected  $increment = 'id';
    public  $timestamps=false;
    protected  $fillable  = [
        'cargo_directivo'
        ];
    
        public static function scopelistaAsignacionDirectivos($query,$dato=''){
            return $query 
                    ->join('cargos_directivos_has_socios','cargos_directivos_id','=','cargos_directivos.id')
                    ->join('personas','personas_dni','=','dni')
                    ->where(function($query)use($dato){
                        $query
                                ->where('dni','like','%'.$dato.'%')
                                ->orwhere('fecha_inicio','like','%'.$dato.'%')
                                ->orwhere('fecha_final','like','%'.$dato.'%')
                                ->orwhere('cargo_directivo','like','%'.$dato.'%')
                                ->orwhere('estado','like','%'.$dato.'%')
                                ->orwhere(\Illuminate\Support\Facades\DB::raw("concat(paterno,' ' ,materno,' ',nombre)"),'like','%'.$dato.'%');
                    })
                    ->select('dni','fecha_inicio','fecha_final','cargo_directivo','estado','cargos_directivos_has_socios.id',
                            \Illuminate\Support\Facades\DB::raw("concat(paterno,' ' ,materno,' ',nombre) as datos"))->paginate(10);
        }
        
        public static function scopegetAsigDirectivo($query,$id){
            return $query 
                    ->join('cargos_directivos_has_socios','cargos_directivos_id','=','cargos_directivos.id')
                    ->join('personas','personas_dni','=','dni')
                    ->where('cargos_directivos_has_socios.id','=',$id)
                    ->select('dni','fecha_inicio','fecha_final','cargos_directivos_id','estado',
                            \Illuminate\Support\Facades\DB::raw("concat(paterno,' ' ,materno,' ',nombre) as datos"))->first();        
        }
}
