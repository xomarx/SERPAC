<?php

namespace App\Http\Requests\Tesoreria;

use App\Http\Requests\Request;

class Persona_juridicaCreateRequest extends Request
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
            'ruc'=>'required|numeric|unique:persona_juridicos,ruc',
            'telefono'=>'required|numeric',
            'razon'=>'required|unique:persona_juridicos,dni',
            'direccion'=>'required'
        ];
    }
    
    public function messages() {
        parent::messages();
        return [
            'ruc.numeric'=>'Solo se permiten numeros',
            'telefono.numeric'=>'Solo se permiten numeros'
        ];
    }
}
