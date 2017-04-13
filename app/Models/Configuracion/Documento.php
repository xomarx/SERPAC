<?php

namespace App\Models\Configuracion;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    //
    protected $table = 'documentos';
    protected $primarykey = 'id';
    public  $timestamps=false;
    protected  $fillable = [
        'enumeracion','importe','tipo_documentos_cod'
    ]; 
    
    public  function tipo_documento()
    {
        return $this->belongsTo(Tipo_documento::class);
    }
    
    public static function enumeracionDoc($idrecibo){
        return \Illuminate\Support\Facades\DB::table('documentos')
                ->where('tipo_documentos_cod','=',$idrecibo) 
                ->select(\Illuminate\Support\Facades\DB::raw('IFNULL(max(enumeracion),0) as enumeracion'))                
                ->first();
    }
}
