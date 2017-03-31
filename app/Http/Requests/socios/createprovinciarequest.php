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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {
                    return [
                        //
                        'provincia' => 'required|unique:provincias',
                        'departamento' => 'required'
                    ];
                }
            case 'PATCH':
            case 'PUT': {
                    return [
                        //
                        'provincia' => 'required|unique:provincias',
                        'departamento' => 'required'
                    ];
                }
            default : break;
        }
    }

    public function messages() {
        parent::messages();
        return [
            'provincia.unique'=>'La Provincia ya Existe',
            'departamento.required'=>'Seleccione un Departamento'
        ];
    }
}
