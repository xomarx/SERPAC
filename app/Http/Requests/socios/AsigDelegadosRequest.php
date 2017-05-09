<?php

namespace App\Http\Requests\socios;

use App\Http\Requests\Request;

class AsigDelegadosRequest extends Request
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
                    'dni'=>'required|numeric|min:8|exists:personas,dni',
                    'delegado'=>'required',
                    'inicio'=>'required|date',
                    'final'=>'numeric|required',
                    'estado'=>'required'
                ];
            case 'PUT':
                return [
            
                ];
            default : break;
        }
        
    }
    
    public function messages() {
        parent::messages();
        return [
            'dni.exists'=>'El DNI no esta Registrado o no Existe'
        ];
    }
}
