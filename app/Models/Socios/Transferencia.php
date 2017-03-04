<?php

namespace App\Models\Socios;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transferencia extends Model
{
    //
    protected $table = 'transferencias';
    protected $increments = 'id';    
    public  $timestamps=false;
    protected  $fillable  = [
        'socios_codigo','motivo','fecha','dniantiguo','dninuevo','users_id','beneficiario_antiguo'
        ];
        public function socio()
        {
            return $this->belongsTo(Socio::class);
        }
        
        public function personaantigua()
        {
            return $this->belongsTo(\App\Models\Persona::class);
        }
        
        public function personanueva()
        {
            return $this->belongsTo(\App\Models\Persona::class);
        }
        
        public static function listaTransferencia()
        {
            return DB::table('transferencias')
                ->join('personas','transferencias.dniantiguo','=','personas.dni')
                ->join('socios','transferencias.socios_codigo','=','socios.codigo')
                ->join('personas as persona2','transferencias.dninuevo','=','persona2.dni')
                ->join('users','transferencias.users_id','=','users.id')
                ->select('transferencias.socios_codigo','personas.paterno as paternoa','personas.materno as maternoa','personas.nombre as nombrea','personas.dni as dnia'
                        ,'persona2.paterno','persona2.materno','persona2.nombre','transferencias.fecha','users.name','transferencias.id','persona2.dni')
                ->get();
        }    
}
