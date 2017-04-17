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
        'kilos','fecha','precio','observacion','total',
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
    
    public static function GetReciCompra($idcompra){
        return DB::table('compras')
                ->where('compras.id','=',$idcompra)
                ->join('sucursales','sucursales_sucursalId','=','sucursalId')
                ->join('documentos','compras.documentos_id','=','documentos.id')
                ->leftjoin('nosocios','nosocios_dni','=','nosocios.dni')
                ->leftjoin('comites_locales','nosocios.comites_locales_id','=','comites_locales.id')
                ->leftjoin('socios','socios_codigo','=','socios.codigo')
                ->leftjoin('personas','socios.dni','=','personas.dni')
                ->leftjoin('comites_locales as co','personas.comites_locales_id','=','co.id')
                ->join('tipo_documentos','tipo_documentos_cod','=','tipo_documentos.codigo')
                ->join('condicions','compras.condicions_id','=','condicions.id')
                ->select('kilos','precio','total','tipocacao','compras.fecha','sucursal','sucursalId','co.comite_local as comitesocio',
                        'enumeracion','tipo_documento','condicion','socios.codigo','comites_locales.comite_local as comitenosocio',
                        DB::raw("concat(nosocios.paterno,' ',nosocios.materno,' ',nosocios.nombres ) as nosocio"),
                        DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre) as socio")
                        )
                ->first();
    }

        public static function SaldoAlmacen($idsucrusal){
        $montoSucursal = DB::table('distribucions')
                ->where('sucursales_sucursalId','=',$idsucrusal)
                ->select(DB::raw('IFNULL(sum(monto),2) as monto'))->first();
        $montocompras = DB::table('compras')
                ->where('sucursales_sucursalId','=',$idsucrusal)
                ->select(DB::raw('IFNULL(sum(total),0) as monto'))->first();
        $monto = ($montoSucursal->monto - $montocompras->monto);
        return $monto;
    }

    public static function scopelistaCompras($query,$dato)
    {
        return $query                
                ->join('condicions','compras.condicions_id','=','condicions.id')
                ->join('sucursales','compras.sucursales_sucursalId','=','sucursales.sucursalId')
                ->join('users','compras.users_id','=','users.id')
                ->join('documentos','compras.documentos_id','=','documentos.id')
                ->leftJoin('socios','compras.socios_codigo','=','socios.codigo')
                ->leftJoin('nosocios','compras.nosocios_dni','=','nosocios.dni')
                ->leftJoin('personas','socios.dni','=','personas.dni')
                ->where('compras.estado','=','CANCELADO')
                ->where(function($query)use($dato){
                    $query
                    ->where('compras.fecha','like','%'.$dato.'%')
                            ->orwhere('condicion','like','%'.$dato.'%')
                            ->orwhere('kilos','like','%'.$dato.'%')
                            ->orwhere('precio','like','%'.$dato.'%')
                            ->orwhere('total','like','%'.$dato.'%')
                            ->orwhere('enumeracion','like','%'.$dato.'%')
                            ->orwhere(DB::raw("concat(nosocios.paterno,' ',nosocios.materno,' ',nosocios.nombres)"),'like','%'.$dato.'%')
                            ->orwhere(DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"),'like','%'.$dato.'%')
                            ->orwhere('sucursal','like','%'.$dato.'%')
                            ->orwhere('name','like','%'.$dato.'%');
                })
                ->select('compras.fecha','compras.socios_codigo','condicions.condicion','compras.kilos','compras.precio'
                        ,'compras.sucursales_sucursalId','compras.id','sucursales.sucursal','users.name','enumeracion'
                        ,'personas.paterno','personas.materno','personas.nombre','nosocios.paterno as npaterno','nosocios.materno as nmaterno','nosocios.nombres as nnombres')
                ->orderby('compras.fecha','desc')
                ->paginate(10);
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
