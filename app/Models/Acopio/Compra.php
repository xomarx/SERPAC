<?php

namespace App\Models\Acopio;

use Illuminate\Database\Eloquent\Model;
use App\Models\Certificacion\Condicion;
use Illuminate\Support\Facades\DB;

class Compra extends Model
{
    //
    protected $table = 'compras';
    protected $primarykey = 'id';
    public  $timestamps=false;
    protected  $fillable = [
        'kilos','fecha','precio','observacion',
        'tipocacao','sucursales_sucursalId','condicions_id',
        'socios_codigo','documentos_id','estado','motivo'];
    
    public function condicion()
    {
        return $this->belongsTo(Condicion::class);
    }
    
    public function socio()
    {
        return $this->belongsTo(\App\Models\Socios\Socio::class);
    }
    
    
    public static function listaCompras()
    {
        return DB::table('compras')                
                ->join('condicions','compras.condicions_id','=','condicions.id')
                ->where('estado','=','CANCELADO')
                ->select('compras.fecha','compras.socios_codigo','condicions.condicion','compras.kilos','compras.precio'
                        ,'compras.sucursales_sucursalId','compras.id')
                ->get();
    }
    
    public static function planillasemanal($sucursal,$fecha,$condicion)
    {
        return DB::table('compras')
                ->join('socios','compras.socios_codigo','=','socios.codigo')
                ->join('condicions','compras.condicions_id','=','condicions.id')
                ->join('personas','socios.dni','=','personas.dni')                
                ->where('compras.estado','=','CANCELADO')
                ->where('compras.fecha','<=',$fecha)
                ->where('compras.condicions_id','=',$condicion)
                ->where('compras.sucursales_sucursalId','=',$sucursal)
                ->select('compras.fecha','compras.socios_codigo','compras.tipocacao','compras.kilos','compras.precio'
                        ,'personas.paterno','personas.materno','personas.nombre')
                ->get();
    }
}
