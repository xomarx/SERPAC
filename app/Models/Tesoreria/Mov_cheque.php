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
    
    

        public static function listaMovCheques(){
        return \Illuminate\Support\Facades\DB::table('mov_cheques')
                ->join('cheques','mov_cheques.cheques_id','=','cheques.id')
                ->join('users','mov_cheques.users_id','=','users.id')                
                ->join('personas','mov_cheques.personas_dni','=','personas.dni')                                
                ->select('mov_cheques.created_at','cheques.cheque','mov_cheques.num_cheque','users.name','mov_cheques.concepto'
                        ,'personas.nombre','personas.paterno','personas.materno','mov_cheques.importe','mov_cheques.id')
                ->get();
    }
}
