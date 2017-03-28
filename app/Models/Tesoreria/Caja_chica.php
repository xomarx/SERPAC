<?php

namespace App\Models\Tesoreria;

use Illuminate\Database\Eloquent\Model;

class Caja_chica extends Model
{
    //
    protected  $fillable = [
        'fecha','num_caja','importe','mov_cheques_id','users_id'
    ];
    
    public static function listaCaja_Chica(){
        return \Illuminate\Support\Facades\DB::table('caja_chicas')
                ->join('users','caja_chicas.users_id','=','users.id')
                ->join('mov_cheques','caja_chicas.mov_cheques_id','=','mov_cheques.id')
                ->join('cheques','mov_cheques.cheques_id','=','cheques.id')
                ->select('caja_chicas.id','caja_chicas.created_at','caja_chicas.num_caja','caja_chicas.importe',
                        'mov_cheques.num_cheque','cheques.cheque','users.name')
                ->get();
    }
    
    public static function listNumCheque($idcheque,$numero){
        return \Illuminate\Support\Facades\DB::table('mov_cheques')
                ->join('cheques','mov_cheques.cheques_id','=','cheques.id')
                ->where('cheques.id','=',$idcheque)
                ->where('mov_cheques.num_cheque','like','%'.$numero.'%')
                ->select('mov_cheques.num_cheque','mov_cheques.id')
                ->take(5)->get();
    }
    
    public static function getCaja($id){
        return \Illuminate\Support\Facades\DB::table('caja_chicas')
                ->join('mov_cheques','caja_chicas.mov_cheques_id','=','mov_cheques.id')
                ->where('caja_chicas.id','=',$id)
                ->select('caja_chicas.importe','caja_chicas.mov_cheques_id','mov_cheques.num_cheque','caja_chicas.id','caja_chicas.num_caja')
                ->first();
    }
}
