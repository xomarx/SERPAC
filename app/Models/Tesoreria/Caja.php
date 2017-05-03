<?php

namespace App\Models\Tesoreria;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    //
    protected  $fillable = [
        'fecha','monto','observacion','users_id','estado','color'  
    ];
    
    public function user(){
        return $this->hasOne(\App\User::class);
    }
    
    public static function scopelistaACcaja($query){
        return $query
                ->join('users','users_id','=','users.id')
                ->select('fecha as start','color','cajas.id',
                \Illuminate\Support\Facades\DB::raw("concat('Monto: S/. ',monto ) as title"))->get();
    }
            
}
