<?php

namespace App\Models\Configuracion;

use Illuminate\Database\Eloquent\Model;

class Tipo_documento extends Model
{
    //
    protected $table = 'tipo_documentos';
    protected $primarykey = 'codigo';
    public  $timestamps=false;
    protected  $fillable = [
        'codigo','tipo_documento','enlace'
    ]; 
    
    public  function documentos()
    {
        return $this->hasMany(Documento::class);
    }
    
    public static function autoCompleteTipo_Doc($codRecibo){
        return \Illuminate\Support\Facades\DB::table('tipo_documentos')
                ->where('codigo','like','%'.$codRecibo.'%')
                ->select('tipo_documento','codigo')
                ->take(4)->get();
    }

}
