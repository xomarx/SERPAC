<?php

namespace App\Models\Tesoreria;

use Illuminate\Database\Eloquent\Model;

class Mov_cheque extends Model
{
    //
    protected $fillable = [
        'num_cheque',
        'concepto',
        'estado',
        'url_cheque',
        'cheques_id',
        'personas_dni',        
        'users_id',
        'importe'
    ];
    
public static function AutoNumCheque($idcheque,$numero){
        return \Illuminate\Support\Facades\DB::table('mov_cheques')
                ->join('cheques','mov_cheques.cheques_id','=','cheques.id')
                ->where('mov_cheques.estado','<>','ANULADO')
                ->where('cheques.id','=',$idcheque)
                ->where('mov_cheques.num_cheque','like','%'.$numero.'%')
                ->select('mov_cheques.num_cheque','mov_cheques.id','mov_cheques.importe')
                ->take(5)->get();
    
}

    public static function scopelistachequesXanio($query,$anio,$mes,$dato){
        if($anio==0)
                return $query->join('cheques', 'mov_cheques.cheques_id', '=', 'cheques.id')
                            ->join('users', 'mov_cheques.users_id', '=', 'users.id')
                            ->join('personas', 'mov_cheques.personas_dni', '=', 'personas.dni')
                            ->where(function($query) use($dato) {
                                $query->where('mov_cheques.created_at', 'like', '%' . $dato . '%')
                                ->orwhere('cheque', 'like', '%' . $dato . '%')
                                ->orwhere('num_cheque', 'like', '%' . $dato . '%')
                                ->orwhere('name', 'like', '%' . $dato . '%')
                                ->orwhere('concepto', 'like', '%' . $dato . '%')
                                ->orwhere('importe', 'like', '%' . $dato . '%')
                                ->orwhere(\Illuminate\Support\Facades\DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%');
                            })
                            ->groupby('cheque')
                            ->select('cheque','cheques.id','num_cuenta')->get();
            else if($mes==0)
                return $query->whereyear('mov_cheques.created_at','=',$anio)
                    ->join('cheques', 'mov_cheques.cheques_id', '=', 'cheques.id')
                            ->join('users', 'mov_cheques.users_id', '=', 'users.id')
                            ->join('personas', 'mov_cheques.personas_dni', '=', 'personas.dni')
                            ->where(function($query) use($dato) {
                                $query->where('mov_cheques.created_at', 'like', '%' . $dato . '%')
                                ->orwhere('cheque', 'like', '%' . $dato . '%')
                                ->orwhere('num_cheque', 'like', '%' . $dato . '%')
                                ->orwhere('name', 'like', '%' . $dato . '%')
                                ->orwhere('concepto', 'like', '%' . $dato . '%')
                                ->orwhere('importe', 'like', '%' . $dato . '%')
                                ->orwhere(\Illuminate\Support\Facades\DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%');
                            })
                            ->groupby('cheque')
                            ->select('cheque','cheques.id','num_cuenta')->get();
            else
                return $query->whereyear('mov_cheques.created_at','=',$anio)
                    ->wheremonth('mov_cheques.created_at','=',$mes)
                    ->join('cheques', 'mov_cheques.cheques_id', '=', 'cheques.id')
                            ->join('users', 'mov_cheques.users_id', '=', 'users.id')
                            ->join('personas', 'mov_cheques.personas_dni', '=', 'personas.dni')
                            ->where(function($query) use($dato) {
                                $query->where('mov_cheques.created_at', 'like', '%' . $dato . '%')
                                ->orwhere('cheque', 'like', '%' . $dato . '%')
                                ->orwhere('num_cheque', 'like', '%' . $dato . '%')
                                ->orwhere('name', 'like', '%' . $dato . '%')
                                ->orwhere('concepto', 'like', '%' . $dato . '%')
                                ->orwhere('importe', 'like', '%' . $dato . '%')
                                ->orwhere(\Illuminate\Support\Facades\DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%');
                            })
                            ->groupby('cheque')
                            ->select('cheque','cheques.id','num_cuenta')->get();
                
    }
    
    public static function scopelistacheques($query,$anio,$dato=''){
        return $query->whereyear('mov_cheques.created_at','=',$anio)
                    ->join('cheques', 'mov_cheques.cheques_id', '=', 'cheques.id') 
                    ->join('users', 'mov_cheques.users_id', '=', 'users.id')
                            ->join('personas', 'mov_cheques.personas_dni', '=', 'personas.dni')                            
                            ->where(function($query) use($dato) {
                                $query->where('mov_cheques.created_at', 'like', '%' . $dato . '%')
                                ->orwhere('cheque', 'like', '%' . $dato . '%')
                                ->orwhere('num_cheque', 'like', '%' . $dato . '%')
                                ->orwhere('name', 'like', '%' . $dato . '%')
                                ->orwhere('concepto', 'like', '%' . $dato . '%')
                                ->orwhere('importe', 'like', '%' . $dato . '%')
                                ->orwhere(\Illuminate\Support\Facades\DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%');
                            })
                            ->groupby('cheque')
                            ->select('cheque','cheques.id','num_cuenta')->get();
    }

    public static function scopelistaMovCheques($query,$anio,$mes,$dato=''){
            if($anio==0)
                return $query->join('cheques', 'mov_cheques.cheques_id', '=', 'cheques.id')
                            ->join('users', 'mov_cheques.users_id', '=', 'users.id')
                            ->join('personas', 'mov_cheques.personas_dni', '=', 'personas.dni')
                            ->where(function($query) use($dato) {
                                $query->where('mov_cheques.created_at', 'like', '%' . $dato . '%')
                                ->orwhere('cheque', 'like', '%' . $dato . '%')
                                ->orwhere('num_cheque', 'like', '%' . $dato . '%')
                                ->orwhere('name', 'like', '%' . $dato . '%')
                                ->orwhere('concepto', 'like', '%' . $dato . '%')
                                ->orwhere('importe', 'like', '%' . $dato . '%')
                                ->orwhere(\Illuminate\Support\Facades\DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%');
                            })
                            ->select('mov_cheques.created_at', 'cheque', 'num_cheque', 'name', 'concepto'
                                    , 'nombre', 'paterno', 'materno', 'importe', 'mov_cheques.id', 'mov_cheques.estado')
                            ->orderby('mov_cheques.created_at', 'desc')
                            ->paginate(10);
            else if($mes==0)
                return $query->whereyear('mov_cheques.created_at','=',$anio)
                    ->join('cheques', 'mov_cheques.cheques_id', '=', 'cheques.id')
                            ->join('users', 'mov_cheques.users_id', '=', 'users.id')
                            ->join('personas', 'mov_cheques.personas_dni', '=', 'personas.dni')
                            ->where(function($query) use($dato) {
                                $query->where('mov_cheques.created_at', 'like', '%' . $dato . '%')
                                ->orwhere('cheque', 'like', '%' . $dato . '%')
                                ->orwhere('num_cheque', 'like', '%' . $dato . '%')
                                ->orwhere('name', 'like', '%' . $dato . '%')
                                ->orwhere('concepto', 'like', '%' . $dato . '%')
                                ->orwhere('importe', 'like', '%' . $dato . '%')
                                ->orwhere(\Illuminate\Support\Facades\DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%');
                            })
                            ->select('mov_cheques.created_at', 'cheque', 'num_cheque', 'name', 'concepto'
                                    , 'nombre', 'paterno', 'materno', 'importe', 'mov_cheques.id', 'mov_cheques.estado')
                            ->orderby('mov_cheques.created_at', 'desc')
                            ->paginate(10);
            else
                return $query->whereyear('mov_cheques.created_at','=',$anio)
                    ->wheremonth('mov_cheques.created_at','=',$mes)
                    ->join('cheques', 'mov_cheques.cheques_id', '=', 'cheques.id')
                            ->join('users', 'mov_cheques.users_id', '=', 'users.id')
                            ->join('personas', 'mov_cheques.personas_dni', '=', 'personas.dni')
                            ->where(function($query) use($dato) {
                                $query->where('mov_cheques.created_at', 'like', '%' . $dato . '%')
                                ->orwhere('cheque', 'like', '%' . $dato . '%')
                                ->orwhere('num_cheque', 'like', '%' . $dato . '%')
                                ->orwhere('name', 'like', '%' . $dato . '%')
                                ->orwhere('concepto', 'like', '%' . $dato . '%')
                                ->orwhere('importe', 'like', '%' . $dato . '%')
                                ->orwhere(\Illuminate\Support\Facades\DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%');
                            })
                            ->select('mov_cheques.created_at', 'cheque', 'num_cheque', 'name', 'concepto'
                                    , 'nombre', 'paterno', 'materno', 'importe', 'mov_cheques.id', 'mov_cheques.estado')
                            ->orderby('mov_cheques.created_at', 'desc')
                            ->paginate(10);
                
    }
            
    public static  function scopeListaReportAnios($query,$anio,$dato='',$idcheque){
        if($anio==0)
            return $query
                ->join('cheques', 'mov_cheques.cheques_id', '=', 'cheques.id')
                            ->join('users', 'mov_cheques.users_id', '=', 'users.id')
                            ->join('personas', 'mov_cheques.personas_dni', '=', 'personas.dni')
                            ->where('cheques_id','=',$idcheque)
                            ->where(function($query) use($dato) {
                                $query->where('mov_cheques.created_at', 'like', '%' . $dato . '%')
                                ->orwhere('cheque', 'like', '%' . $dato . '%')
                                ->orwhere('num_cheque', 'like', '%' . $dato . '%')
                                ->orwhere('name', 'like', '%' . $dato . '%')
                                ->orwhere('concepto', 'like', '%' . $dato . '%')
                                ->orwhere('importe', 'like', '%' . $dato . '%')
                                ->orwhere(\Illuminate\Support\Facades\DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%');
                            })
                ->select(\Illuminate\Support\Facades\DB::raw('year(mov_cheques.created_at) as fecha'))
                ->groupby(\Illuminate\Support\Facades\DB::raw('year(mov_cheques.created_at)'))
                ->get();
        else
            return $query->whereyear('mov_cheques.created_at','=',$anio)
                            ->join('cheques', 'mov_cheques.cheques_id', '=', 'cheques.id')
                            ->join('users', 'mov_cheques.users_id', '=', 'users.id')
                            ->join('personas', 'mov_cheques.personas_dni', '=', 'personas.dni')
                            ->where('cheques_id','=',$idcheque)
                            ->where(function($query) use($dato) {
                                $query->where('mov_cheques.created_at', 'like', '%' . $dato . '%')
                                ->orwhere('cheque', 'like', '%' . $dato . '%')
                                ->orwhere('num_cheque', 'like', '%' . $dato . '%')
                                ->orwhere('name', 'like', '%' . $dato . '%')
                                ->orwhere('concepto', 'like', '%' . $dato . '%')
                                ->orwhere('importe', 'like', '%' . $dato . '%')
                                ->orwhere(\Illuminate\Support\Facades\DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%');
                            })
                ->select(\Illuminate\Support\Facades\DB::raw('year(mov_cheques.created_at) as fecha'))
                ->groupby(\Illuminate\Support\Facades\DB::raw('year(mov_cheques.created_at)'))->get();
                                
    }

    public static function scopeListaExcelAnios($query,$anio,$dato=''){
        if($anio==0)
            return $query
                ->join('cheques', 'mov_cheques.cheques_id', '=', 'cheques.id')
                            ->join('users', 'mov_cheques.users_id', '=', 'users.id')
                            ->join('personas', 'mov_cheques.personas_dni', '=', 'personas.dni')                            
                            ->where(function($query) use($dato) {
                                $query->where('mov_cheques.created_at', 'like', '%' . $dato . '%')
                                ->orwhere('cheque', 'like', '%' . $dato . '%')
                                ->orwhere('num_cheque', 'like', '%' . $dato . '%')
                                ->orwhere('name', 'like', '%' . $dato . '%')
                                ->orwhere('concepto', 'like', '%' . $dato . '%')
                                ->orwhere('importe', 'like', '%' . $dato . '%')
                                ->orwhere(\Illuminate\Support\Facades\DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%');
                            })
                ->select(\Illuminate\Support\Facades\DB::raw('year(mov_cheques.created_at) as fecha'))
                ->groupby(\Illuminate\Support\Facades\DB::raw('year(mov_cheques.created_at)'))
                ->get();
        else
            return $query->whereyear('mov_cheques.created_at','=',$anio)
                            ->join('cheques', 'mov_cheques.cheques_id', '=', 'cheques.id')
                            ->join('users', 'mov_cheques.users_id', '=', 'users.id')
                            ->join('personas', 'mov_cheques.personas_dni', '=', 'personas.dni')                            
                            ->where(function($query) use($dato) {
                                $query->where('mov_cheques.created_at', 'like', '%' . $dato . '%')
                                ->orwhere('cheque', 'like', '%' . $dato . '%')
                                ->orwhere('num_cheque', 'like', '%' . $dato . '%')
                                ->orwhere('name', 'like', '%' . $dato . '%')
                                ->orwhere('concepto', 'like', '%' . $dato . '%')
                                ->orwhere('importe', 'like', '%' . $dato . '%')
                                ->orwhere(\Illuminate\Support\Facades\DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%');
                            })
                ->select(\Illuminate\Support\Facades\DB::raw('year(mov_cheques.created_at) as fecha'))
                ->groupby(\Illuminate\Support\Facades\DB::raw('year(mov_cheques.created_at)'))->get();
    }

    public static function scopelistameses($query,$anio,$mes,$dato,$idcheque){
        if($mes==0)
            return $query->whereyear('mov_cheques.created_at','=',$anio)
                ->join('cheques', 'mov_cheques.cheques_id', '=', 'cheques.id')
                            ->join('users', 'mov_cheques.users_id', '=', 'users.id')
                            ->join('personas', 'mov_cheques.personas_dni', '=', 'personas.dni')
                            ->where('cheques_id','=',$idcheque)
                            ->where(function($query) use($dato) {
                                $query->where('mov_cheques.created_at', 'like', '%' . $dato . '%')
                                ->orwhere('cheque', 'like', '%' . $dato . '%')
                                ->orwhere('num_cheque', 'like', '%' . $dato . '%')
                                ->orwhere('name', 'like', '%' . $dato . '%')
                                ->orwhere('concepto', 'like', '%' . $dato . '%')
                                ->orwhere('importe', 'like', '%' . $dato . '%')
                                ->orwhere(\Illuminate\Support\Facades\DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%');
                            })
                ->select(\Illuminate\Support\Facades\DB::raw('month(mov_cheques.created_at) as mes'))
                ->groupby(\Illuminate\Support\Facades\DB::raw('month(mov_cheques.created_at)'))->get();
        else
            return $query->whereyear('mov_cheques.created_at','=',$anio)
                ->wheremonth('mov_cheques.created_at','=',$mes)
                ->join('cheques', 'mov_cheques.cheques_id', '=', 'cheques.id')
                            ->join('users', 'mov_cheques.users_id', '=', 'users.id')
                            ->join('personas', 'mov_cheques.personas_dni', '=', 'personas.dni')
                            ->where('cheques_id','=',$idcheque)
                            ->where(function($query) use($dato) {
                                $query->where('mov_cheques.created_at', 'like', '%' . $dato . '%')
                                ->orwhere('cheque', 'like', '%' . $dato . '%')
                                ->orwhere('num_cheque', 'like', '%' . $dato . '%')
                                ->orwhere('name', 'like', '%' . $dato . '%')
                                ->orwhere('concepto', 'like', '%' . $dato . '%')
                                ->orwhere('importe', 'like', '%' . $dato . '%')
                                ->orwhere(\Illuminate\Support\Facades\DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%');
                            })
                ->select(\Illuminate\Support\Facades\DB::raw('month(mov_cheques.created_at) as mes'))
                ->groupby(\Illuminate\Support\Facades\DB::raw('month(mov_cheques.created_at)'))->get();
        
    }

    public static function scopeListaRepoMovCheques($query,$anio,$mes,$dato='',$idcheque){                    
                return $query->whereyear('mov_cheques.created_at','=',$anio)
                    ->wheremonth('mov_cheques.created_at','=',$mes)
                    ->join('cheques', 'mov_cheques.cheques_id', '=', 'cheques.id')
                            ->join('users', 'mov_cheques.users_id', '=', 'users.id')
                            ->join('personas', 'mov_cheques.personas_dni', '=', 'personas.dni')
                            ->where('cheques_id','=',$idcheque)
                            ->where(function($query) use($dato) {
                                $query->where('mov_cheques.created_at', 'like', '%' . $dato . '%')
                                ->orwhere('cheque', 'like', '%' . $dato . '%')
                                ->orwhere('num_cheque', 'like', '%' . $dato . '%')
                                ->orwhere('name', 'like', '%' . $dato . '%')
                                ->orwhere('concepto', 'like', '%' . $dato . '%')
                                ->orwhere('importe', 'like', '%' . $dato . '%')
                                ->orwhere(\Illuminate\Support\Facades\DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%');
                            })
                            ->select(\Illuminate\Support\Facades\DB::raw('date(mov_cheques.created_at) as fecha'), 'cheque', 'num_cheque', 'name', 'concepto'
                                    , 'nombre', 'paterno', 'materno', 'importe', 'mov_cheques.id', 'mov_cheques.estado','mov_cheques.estado')
                            ->orderby('mov_cheques.created_at', 'asc')
                            ->get();
    }
    
        public static function getMovCheque($id){
        return \Illuminate\Support\Facades\DB::table('mov_cheques')
                ->join('personas','mov_cheques.personas_dni','=','personas.dni')
                ->where('mov_cheques.id','=',$id)
                ->select('mov_cheques.num_cheque','mov_cheques.concepto','personas.nombre','personas.paterno','mov_cheques.id'
                        ,'personas.materno','mov_cheques.importe','mov_cheques.cheques_id','mov_cheques.url_cheque','personas.dni')
                ->first();
    }
}
