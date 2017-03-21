<?php

namespace App\Http\Requests\Configuracion;

use App\Http\Requests\Request;

class RolCreateRequest extends Request
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
    public function rules() {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {
                    return [
                        //
                        'rol' => 'required|min:4|unique:roles,name',
                        'tag' => 'required|alpha_dash|min:4|unique:roles,display_name',
                        'descripcion' => 'required'
                    ];
                }
            case 'PATCH':
            case 'PUT': {
                    return [
                        //
                        'rol' => 'required|min:4',
                        'tag' => 'required|alpha_dash|min:4',
                        'descripcion' => 'required'
                    ];
                }
            default : break;
        }
    }

    public function messages() {
        parent::messages();
        return [
            'rol.unique'=>'El nombre del rol ya se encuentra Registrado',
            'tag.alpha_dash'=>'No se permiten en el tag espacios y numeros',
            'descripcion.required'=>'Es obligatorio la descripcion del Rol'
        ];
    }
}
