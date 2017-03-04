<?php

namespace App\Http\Requests\socios;

use App\Http\Requests\Request;

class createdistritorequest extends Request
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
            'distrito'=>'required|unique:distritos',
            'provincia'=>'required',
            'departamento'=>'required'
        ];
    }
    
    public function messages() {
        parent::messages();
        return [
            'distrito.unique'=>'Ya existe ese Distrito',
            'provincia.required'=>'Seleccione una Provincia',
            'departamento.required'=>'Seleccione un departamento'
        ];
    }
}
