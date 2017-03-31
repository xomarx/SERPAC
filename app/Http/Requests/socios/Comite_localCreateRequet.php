<?php

namespace App\Http\Requests\socios;

use App\Http\Requests\Request;

class Comite_localCreateRequet extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can(['editar local','crear local','eliminar local']);
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
                        'departamento' => 'required',
                        'provincia' => 'required',
                        'distrito' => 'required',
                        'comite_central' => 'required',
                        'comite_local' => 'required|unique:comites_locales,comite_local'
                    ];
                }
            case 'PATCH':
            case 'PUT': {
                    return [
                        'departamento' => 'required',
                        'provincia' => 'required',
                        'distrito' => 'required',
                        'comite_central' => 'required',
                        'comite_local' => 'required|unique:comites_locales,comite_local'
                    ];
                }
            default : break;
        }
    }

    public function messages() {
        parent::messages();
        return [
            'comite_local.unique'=>'El comite local ya existe',
            'departamento.required'=>'Seleccione un departamento',
            'provincia.required'=>'Seleccione un provincia',
            'distrito.required'=>'Seleccione un distrito',
            'comite_central.required'=>'Seleccione un comite central'
        ];
    }
}
