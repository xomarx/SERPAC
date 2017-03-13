<?php

namespace App\Http\Requests\Tesoreria;

use App\Http\Requests\Request;

class GastosAcopioCreateRequest extends Request
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
            'fecha'=>'required|date',
            'monto'=>'required|numeric',
            'egresos'=>'required',
            'almacen'=>'required'
        ];
    }
    
    public function messages() {
        parent::messages();
        return [
            'egresos.required'=>'Seleccione un Pago'
        ];
    }
}
