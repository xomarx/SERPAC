<?php

namespace App\Http\Requests\RRHH;

use App\Http\Requests\Request;

class EmpresaRequest extends Request
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
        switch ($this->method()){
            case 'POST':
                return [
                    'empresa'=>'required|unique:empresas,empresa',
                    'ruc'=>'required|unique:empresas,ruc|numeric',
                    'direccion'=>'required'
                ];
            case 'PUT':
                return [
                    'empresa'=>'required',
                    'ruc'=>'required|numeric',
                    'direccion'=>'required'
                ];
            default: break;
        }
    }
}
