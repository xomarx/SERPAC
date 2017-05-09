<?php

namespace App\Http\Requests\socios;

use App\Http\Requests\Request;

class createparientesrequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can(['crear parientes','editar parientes']);
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
                        //
                        'dni' => 'required | unique:parientes,personas_dni|numeric',
                        'paterno' => 'required | max: 60',
                        'materno' => 'required | max:60',
                        'nombre' => 'required | max:60',
                        'fec_nac' => 'required|date',
                        'grado_inst' => 'required',
                        'estado_civil' => 'required',
                        'direccion' => 'required',
                        'comite_local' => 'required',
                        'tipo_pariente' => 'required',
                    ];
                }
            case 'PATCH':
            case 'PUT': {
                    return [                        
                        'paterno' => 'required | max: 60',
                        'materno' => 'required | max:60',
                        'nombre' => 'required | max:60',
                        'fec_nac' => 'required|date',
                        'grado_inst' => 'required',
                        'estado_civil' => 'required',
                        'direccion' => 'required',
                        'comite_local' => 'required',
                        'tipo_pariente' => 'required',
                    ];
                }
            default : break;
        }        
    }
    
    public function messages() {
        parent::messages();
        return [                        
            'estado_civil.required'=>'Seleccione un estado Civil Valido',            
            'grado_inst.required'=>'seleccione un grado de instruccion valido',                        
            'dni.unique'=>'el numero del DNI ya existe',
            'paterno.required'=>'el apellido paterno contiene numeros',
            'materno.required'=>'el apellido materno contiene numeros en el texto',
            'nombre.required'=>'el nombre contiene numeros en el texto',
            'fec_nac.date'=>'la fecha de neciemiento es incorrecta',            
            'direccion.required'=>'ingrese la direccion del pariente',
            'comites_locales_id.required'=>'Seleccione un Comite Local',
            'tipo_pariente.required'=>'Seleccione el tipo de Pariente',            
        ];
    }
}
