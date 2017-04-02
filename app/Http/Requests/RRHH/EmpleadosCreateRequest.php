<?php

namespace App\Http\Requests\RRHH;

use App\Http\Requests\Request;

class EmpleadosCreateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {
                    return [
                        'codigo' => 'required|unique:empleados,empleadoId',
                        'dni' => 'required|unique:empleados,personas_dni|numeric|min:8',
                        'ruc' => 'required|unique:empleados,ruc|numeric|min:11',
                        'estado' => 'required',
                        'estado_civil' => 'required',
                        'area' => 'required',
                        'cargo' => 'required',
                        'paterno' => 'required',
                        'materno' => 'required',
                        'nombre' => 'required',
                        'fec_nac' => 'required|date',
                        'profesion' => 'required',
                        'departamento' => 'required',
                        'provincia' => 'required',
                        'distrito' => 'required',
                        'comite_central' => 'required',
                        'comite_local' => 'required',
                        'email' => 'email|required',
                        'direccion' => 'required',
                    ];
                }
            case 'PATCH':
            case 'PUT': {
                    return [
                        'codigo' => 'required',
                        'dni' => 'required|numeric',
                        'ruc' => 'required|numeric|min:11',
                        'estado' => 'required',
                        'estado_civil' => 'required',
                        'area' => 'required',
                        'cargo' => 'required',
                        'paterno' => 'required',
                        'materno' => 'required',
                        'nombre' => 'required',
                        'fec_nac' => 'required|date',
                        'profesion' => 'required',
                        'departamento' => 'required',
                        'provincia' => 'required',
                        'distrito' => 'required',
                        'comite_central' => 'required',
                        'comite_local' => 'required',
                        'email' => 'email|required',
                        'direccion' => 'required',
                    ];
                }
            default : break;
        }
    }
    
    public function messages() {
        parent::messages();
        return [
            'codigo.unique'=>'El Codigo del empleado ya Existe',
            'dni.unique'=>'El N° del D.N.I. ya se Encuentra registrado en un empleado',
            'ruc.unique'=>'El N° de R.U.C. ya esta registrado con un Empleado',
            'estado.required'=>'Seleccione un Estado',
            'estado_civil.required'=>'Seleccione un estado civil',
            'area.required'=>'Seleccione una Area a la que pertenece',
            'cargo.required'=>'Seleccione el cargo que le pertenece',
            'paterno.required'=>'Ingrese su apellido paterno',
            'materno.required'=>'Ingrese su apellido materno',
            'nombre.required'=>'Ingrese su nombre completo',
            'fec_nac.date'=>'no cuenta con el formato Correcto',
            'profesion.required'=>'Es obligatorio ingresar su profesion o carrera',
            'departamento.required'=>'Seleccione un departamento',
            'provincia.required'=>'Seleccione un provincia',
            'distrito.required'=>'Seleccione un distrito',
            'comite_central.required'=>'Seleccione un comite central',
            'comite_local.required'=>'Seleccione un comite local',
            'email.required'=>'Ingrese su correo electronico',
            'direccion.required'=>'Ingrese su direccion de su casa'            
        ];
    }
}
