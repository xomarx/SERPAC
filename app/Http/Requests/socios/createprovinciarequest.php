<?php

namespace App\Http\Requests\socios;

use App\Http\Requests\Request;

class createprovinciarequest extends Request
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
            'provincia'=>'required|unique:provincias',
            'departamento'=>'required'
        ];
    }
    
    public function messages() {
        parent::messages();
        return [
            'provincia.unique'=>'La Provincia ya Existe',
            'departamento.required'=>'Seleccione un Departamento'
        ];
    }
}
