<?php

namespace App\Models\Acopio;

use Illuminate\Database\Eloquent\Model;

class Planilla extends Model
{
    //
    protected $table = 'planillas';
    protected $primarykey = 'id';
    public  $timestamps=false;
    protected  $fillable = [
        'numero','fecha','users_id'
        ];
    
        public function compras(){
            return $this->belongsToMany( Compra::class, 'compras_id');
        }
        
        public static function listaPlanilla(){
            return \Illuminate\Support\Facades\DB::table('planillas')
                    ->join('compras_has_planillas','planillas.id','=','compras_has_planillas.planillas_id')
                    ->join('compras','compras_has_planillas.compras_id','=','compras.id')
                    ->join('sucursales','compras.sucursales_sucursalId','=','sucursales.sucursalId')
                    ->join('users','planillas.users_id','=','users.id')
                    ->where('compras.estado','=','CANCELADO')
                    ->groupby('compras_has_planillas.planillas_id')
                    ->select('planillas.fecha','planillas.numero','sucursales.sucursalId','sucursales.sucursal','users.name','planillas.id')
                    ->paginate(10);
        }
}
