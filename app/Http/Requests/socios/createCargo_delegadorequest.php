<?php

namespace App\Http\Requests\socios;

use App\Http\Requests\Request;

class createCargo_delegadorequest extends Request
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
            'cargo_delegado'=>'required|unique:cargos_delegados'
        ];
    }
    
    public function messages() {
        parent::messages();
        return ['cargo_delegado.unique'=>'El Cargo del delegado ya Existe'];
    }
}
