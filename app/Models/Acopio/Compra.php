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
        'socios_codigo','documentos_id','estado','motivo','users_id','nosocios_dni'];
    
    public function condicion()
    {
        return $this->belongsTo(Condicion::class);
    }
    
    public function socio()
    {
        return $this->belongsTo(\App\Models\Socios\Socio::class);
    }
    
    public function plantillas(){
        return $this->belongsToMany(Planilla::class, 'planillas_id');
    }


    public static function listaCompras()
    {
        return DB::table('compras')                
                ->join('condicions','compras.condicions_id','=','condicions.id')
                ->join('sucursales','compras.sucursales_sucursalId','=','sucursales.sucursalId')
                ->join('users','compras.users_id','=','users.id')
                ->leftJoin('socios','compras.socios_codigo','=','socios.codigo')
                ->leftJoin('nosocios','compras.nosocios_dni','=','nosocios.dni')
                ->leftJoin('personas','socios.dni','=','personas.dni')
                ->where('compras.estado','=','CANCELADO')
                ->select('compras.fecha','compras.socios_codigo','condicions.condicion','compras.kilos','compras.precio'
                        ,'compras.sucursales_sucursalId','compras.id','sucursales.sucursal','users.name'
                        ,'personas.paterno','personas.materno','personas.nombre','nosocios.paterno as npaterno','nosocios.materno as nmaterno','nosocios.nombres as nnombres')
                ->get();
    }
    
    public static function listaPlanillaSemanal($sucursal,$fecha,$condicion)
    {
        return DB::table('compras')
                ->leftJoin('compras_has_planillas','compras.id','=','compras_has_planillas.compras_id')                
                ->leftJoin('socios','compras.socios_codigo','=','socios.codigo')
                ->leftJoin('nosocios','compras.nosocios_dni','=','nosocios.dni')
                ->leftJoin('personas','socios.dni','=','personas.dni')
                ->where('compras_has_planillas.compras_id')
                ->where('compras.estado','=','CANCELADO')
                ->where('compras.fecha','<=',  \Carbon\Carbon::parse($fecha))
                ->where('compras.condicions_id','=',$condicion)
                ->where('compras.sucursales_sucursalId','=',$sucursal)                
                ->select('compras.fecha','compras.socios_codigo','compras.tipocacao','compras.kilos','compras.precio','compras.id'
                        ,'personas.paterno','personas.materno','personas.nombre','nosocios.paterno as npaterno','nosocios.materno as nmaterno','nosocios.nombres as nnombres'
                        )
                ->get();
    }
}
