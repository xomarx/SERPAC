<?php

namespace App\Http\Requests\socios;

use App\Http\Requests\Request;

class Updatesociorquest extends Request
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
        return [
            //            
            'fec_asociado' => 'required|date',
            'fec_empadron' => 'required',
            'estado_civil'=>'required',
            'ocupacion'=>'required | max:60|Alpha',
            'grado_inst'=>'required',
            'produccion'=>'required | max:30|Alpha',
            'estado'=>'required',
//            'observacion'=>'required',            
            'paterno'=>'required | max: 60',
            'materno'=>'required | max:60',
            'nombre'=>'required | max:60',
            'fec_nac'=>'required|date',
            'sexo'=>'required',
            'direccion'=>'required',
//            'comites_locales_id'=>'required'
        ];
    }
    
    public function messages() {
        parent::messages();
        return [
            
            'fec_asociado.date'=>'la fecha de asociado no tiene el formato correcto',
            'fec_empadron.date'=>'la fecha de Empadronamiento no tiene el formato correcto',
            'estado_civil.required'=>'Seleccione un estado Civil Valido',
            'ocupacion.Alpha'=>'la ocupacion no puede contener numeros en su nombre',
            'grado_inst.required'=>'seleccione un grado de instruccion valido',
            'produccion.Alpha'=>'la produccion no puede contener en su nombre numeros',
            'estado.required'=>'seleccione un estado valido',
            
            'paterno.required'=>'el apellido paterno contiene numeros',
            'materno.required'=>'el apellido materno contiene numeros en el texto',
            'nombre.required'=>'el nombre contiene numeros en el texto',
            'fec_nac.date'=>'la fecha de neciemiento es incorrecta',
            'sexo.required'=>'seleccione el sexo del socio',
            'direccion.required'=>'ingrese la direccion del socio',
//            'comites_locales_id.required'=>'seleccione un comite local valido',                        
        ];
    }
}
