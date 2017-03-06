<?php

namespace App\Http\Requests\Tesoreria;

use App\Http\Requests\Request;

class distribucionCreateRequest extends Request
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
            'sucursal'=>'required',
            'tecnico'=>'required',
            'monto'=>'required|numeric',
            'fecha'=>'required|date'
        ];
    }
    
    public function messages() {
        parent::messages();
        return [
            'sucursal.required'=>'Seleccione un Centro de Acopio',
            'tecnico.required'=>'Seleccione un Tecnico',
            'monto.regex'=>'Solo Decimales',
            'fecha.date'=>'La fecha no contiene el Formato correcto'
        ];
    }
}
