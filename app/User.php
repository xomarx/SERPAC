<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
    
    public static function usuarios(){
        return \Illuminate\Support\Facades\DB::table('users')
                ->join('empleados','users.empleados_empleadoId','=','empleados.empleadoId')
                ->join('personas','empleados.personas_dni','=','personas.dni')
                ->select('users.name','users.email','personas.paterno','personas.materno','personas.nombre','users.created_at')
                ->get();
    }
}
