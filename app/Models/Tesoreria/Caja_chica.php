<?php

namespace App\Models\Tesoreria;

use Illuminate\Database\Eloquent\Model;

class Caja_chica extends Model
{
    //
    protected  $fillable = [
        'fecha','num_caja','importe','mov_cheques_id','users_id'
    ];
    
    public function user(){
        return $this->hasOne(\App\User::class);
    }

    public static function scopelistaCaja_Chica($query,$anio,$mes,$dato=''){
        if($anio==0)
            return $query
                ->join('users','caja_chicas.users_id','=','users.id')
                ->join('mov_cheques','caja_chicas.mov_cheques_id','=','mov_cheques.id')
                ->join('cheques','mov_cheques.cheques_id','=','cheques.id')
                ->where(function($query)use($dato){
                    $query->where('num_caja', 'like', '%' . $dato . '%')
                                ->orwhere('caja_chicas.created_at', 'like', '%' . $dato . '%')
                                ->orwhere('num_cheque', 'like', '%' . $dato . '%')
                                ->orwhere('name', 'like', '%' . $dato . '%')
                                ->orwhere('caja_chicas.importe', 'like', '%' . $dato . '%')
                                ->orwhere('cheque', 'like', '%' . $dato . '%');
                })
                ->select('caja_chicas.id','caja_chicas.created_at','num_caja','caja_chicas.importe',
                        'num_cheque','cheque','name')
                ->orderby('caja_chicas.created_at','desc')
                ->paginate(10);
        else if($mes==0)
            return $query->whereyear('caja_chicas.created_at','=',$anio)
                ->join('users','caja_chicas.users_id','=','users.id')
                ->join('mov_cheques','caja_chicas.mov_cheques_id','=','mov_cheques.id')
                ->join('cheques','mov_cheques.cheques_id','=','cheques.id')
                ->where(function($query)use($dato){
                    $query->where('num_caja', 'like', '%' . $dato . '%')
                                ->orwhere('caja_chicas.created_at', 'like', '%' . $dato . '%')
                                ->orwhere('num_cheque', 'like', '%' . $dato . '%')
                                ->orwhere('name', 'like', '%' . $dato . '%')
                                ->orwhere('caja_chicas.importe', 'like', '%' . $dato . '%')
                                ->orwhere('cheque', 'like', '%' . $dato . '%');
                })
                ->select('caja_chicas.id','caja_chicas.created_at','num_caja','caja_chicas.importe',
                        'num_cheque','cheque','name')
                ->orderby('caja_chicas.created_at','desc')
                ->paginate(10);
        else
            return $query->whereyear('caja_chicas.created_at','=',$anio)
                ->wheremonth('caja_chicas.created_at','=',$mes)
                ->join('users','caja_chicas.users_id','=','users.id')
                ->join('mov_cheques','caja_chicas.mov_cheques_id','=','mov_cheques.id')
                ->join('cheques','mov_cheques.cheques_id','=','cheques.id')
                ->where(function($query)use($dato){
                    $query->where('num_caja', 'like', '%' . $dato . '%')
                                ->orwhere('caja_chicas.created_at', 'like', '%' . $dato . '%')
                                ->orwhere('num_cheque', 'like', '%' . $dato . '%')
                                ->orwhere('name', 'like', '%' . $dato . '%')
                                ->orwhere('caja_chicas.importe', 'like', '%' . $dato . '%')
                                ->orwhere('cheque', 'like', '%' . $dato . '%');
                })                
                ->select('caja_chicas.id','caja_chicas.created_at','num_caja','caja_chicas.importe',
                        'num_cheque','cheque','name')
                ->orderby('caja_chicas.created_at','desc')
                ->paginate(10);                        
    }
    
   
    
    public static function getCaja($id){
        return \Illuminate\Support\Facades\DB::table('caja_chicas')
                ->join('mov_cheques','caja_chicas.mov_cheques_id','=','mov_cheques.id')
                ->join('cheques','mov_cheques.cheques_id','=','cheques.id')
                ->where('caja_chicas.id','=',$id)
                ->select('caja_chicas.importe','cheques.id','mov_cheques.num_cheque','caja_chicas.num_caja')
                ->first();
    }
}
