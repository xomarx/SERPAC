<?php

namespace App\Http\Requests\socios;

use App\Http\Requests\Request;

class SociocreateRequest extends Request
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
    public function rules() {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {                
                    return [
                        //
                        'codigo' => 'required|unique:socios,codigo|min:9|max:9',
                        'fec_asociado' => 'required|date',
                        'fec_empadron' => 'required',
                        'estado_civil' => 'required',
                        'ocupacion' => 'required | max:60|Alpha',
                        'grado_inst' => 'required',
                        'produccion' => 'required | max:30|Alpha',
                        'estado' => 'required',
                        'dni' => 'required | unique:socios,dni|numeric',
                        'paterno' => 'required | max: 60',
                        'materno' => 'required | max:60',
                        'nombre' => 'required | max:60',
                        'fec_nac' => 'required|date',
                        'sexo' => 'required',
                        'direccion' => 'required',
                        'comite_local' => 'required',
                        'sexo'=>'required',
                        'condicion'=>'required'
                    ];
                }
            case 'PATCH':
            case 'PUT': {
                    return [
                        //            
                        'fec_asociado' => 'required|date',
                        'fec_empadron' => 'required',
                        'estado_civil' => 'required',
                        'ocupacion' => 'required | max:60|Alpha',
                        'grado_inst' => 'required',
                        'produccion' => 'required | max:30|Alpha',
                        'estado' => 'required',
//            'observacion'=>'required',            
                        'paterno' => 'required | max: 60',
                        'materno' => 'required | max:60',
                        'nombre' => 'required | max:60',
                        'fec_nac' => 'required|date',
                        'sexo' => 'required',
                        'direccion' => 'required',
//            'comites_locales_id'=>'required'
                    ];
                }
            default : break;
        }
    }

    public function messages() {
        parent::messages();
        return [
            'codigo.unique'=>'El Codigo ya existe, Ingrese un nuevo Codigo valido',
            'fec_asociado.date'=>'la fecha de asociado no tiene el formato correcto',
            'fec_empadron.date'=>'la fecha de Empadronamiento no tiene el formato correcto',
            'estado_civil.required'=>'Seleccione un estado Civil Valido',
            'ocupacion.Alpha'=>'la ocupacion no puede contener numeros en su nombre',
            'grado_inst.required'=>'seleccione un grado de instruccion valido',
            'produccion.Alpha'=>'la produccion no puede contener en su nombre numeros',
            'estado.required'=>'seleccione un estado valido',
            'dni.unique'=>'el numero del DNI ya existe',
            'paterno.required'=>'el apellido paterno contiene numeros',
            'materno.required'=>'el apellido materno contiene numeros en el texto',
            'nombre.required'=>'el nombre contiene numeros en el texto',
            'fec_nac.date'=>'la fecha de neciemiento es incorrecta',
            'sexo.required'=>'seleccione el sexo del socio',
            'direccion.required'=>'ingrese la direccion del socio',
            'comite_local.required'=>'seleccione un comite local valido',                        
        ];
    }
}
