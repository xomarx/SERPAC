<?php

namespace App\Http\Requests\socios;

use App\Http\Requests\Request;

class createDepartamentorequest extends Request
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
           'departamento'=>'required|unique:departamentos'
        ];
    }
    
    public function messages() {
        parent::messages();
        return ['departamento.unique'=>'El nombre del departamento ya Existe'];
    }
}
