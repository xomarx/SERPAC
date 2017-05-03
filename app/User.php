<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use \Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use EntrustUserTrait; //hacemos uso del trait en la clase User para hacer uso de sus métodos
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','remember_token','empleados_empleadoId'
    ];
    
    public function socios()
    {
        return $this->hasMany(Models\Socios\Socio::class);
    }
    
    public function fundos()
    {
        return $this->hasMany(Models\Socios\Fundo::class);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    //establecemos las relaciones con el modelo Role, ya que un usuario puede tener varios roles
    //y un rol lo pueden tener varios usuarios
    public function roles(){
        return $this->belongsToMany(Role::class);
    }
    
    public function caja(){
        return $this->belongsTo(Models\Tesoreria\Caja::class);
    }


    public static function usuarios(){
        return \Illuminate\Support\Facades\DB::table('users')
                ->join('empleados','users.empleados_empleadoId','=','empleados.empleadoId')
                ->join('personas','empleados.personas_dni','=','personas.dni')
                ->leftjoin('role_user','users.id','=','role_user.user_id')
                ->leftjoin('roles','role_user.role_id','=','roles.id')
                ->select('users.name','users.email','personas.paterno','personas.materno','personas.nombre','users.created_at','users.estado'
                        ,'roles.name as rol')
                ->get();
    }
}
