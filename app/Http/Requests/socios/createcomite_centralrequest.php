<?php

namespace App\Http\Requests\socios;

use App\Http\Requests\Request;

class createcomite_centralrequest extends Request
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
            'departamento'=>'required',
            'provincia'=>'required',
            'distrito'=>'required',
            'comite_central'=>'required|unique:comites_centrales,comite_central'
        ];
    }
    
    public function messages() {
        parent::messages();
        return [
            'departamento.required'=>'Seleccione un departamento',
            'provincia.required'=>'Seleccione una provincia',
            'distrito.required'=>'Seleccione un distrito',
            'comite_central.unique'=>'El comite central ya Existe'
        ];
    }
}
