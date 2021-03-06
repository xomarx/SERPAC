<?php

namespace App\Http\Requests\socios;

use App\Http\Requests\Request;

class createfundorequest extends Request
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
                        'fundo' => 'required|unique:fundos,fundo',
                        'estadofundo' => 'required',
                        'fecha' => 'required | date',
                        'comite_local' => 'required',
                        'direccion' => 'required',
                    ];
                }
            case 'PATCH':
            case 'PUT': {
                    return [
                    ];
                }
            default : break;
        }
    }
    
    public function messages() {
        parent::messages();
        return [
            'fundo.unique'=>'Ya existe este fundo',
            'estadofundo.required'=>'Seleccione un estado de Psoesion',
            'fecha.date'=>'Formate incorrecto de la fecha',
            'comite_local_id.required'=>'Seleccione un Comite Local',
            'direccion.required'=>'Ingrese la Direccion del Fundo'
        ];
    }
}
