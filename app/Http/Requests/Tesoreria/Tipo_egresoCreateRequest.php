<?php

namespace App\Http\Requests\Tesoreria;

use App\Http\Requests\Request;

class Tipo_egresoCreateRequest extends Request
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
            'tipo'=>'required|unique:tipo_egresos,tipo_egreso',
            'descripcion'=>'required'
        ];
    }
    
    public function messages() {
        parent::messages();
        
        return [
            'tipo.unique'=>'El nombre ya Existe'
        ];
    }
}
