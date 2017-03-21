<?php

namespace App\Http\Requests\Configuracion;

use App\Http\Requests\Request;

class PermisosCreateRequest extends Request
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
                        'permiso' => 'required|min:4|unique:permissions,name',
                        'tag' => 'required|alpha_dash|min:4|unique:permissions,display_name',
                        'descripcion' => 'required'
                    ];
                }
            case 'PATCH':
            case 'PUT': {
                    return [
                        //
                        'permiso' => 'required|min:4',
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
            'permiso.unique'=>'El nombre del permiso ya se encuentra registrado',
            'tag.alpha_dash'=>'No se permiten en el tag espacios y ni numeros',
            'descripcion.required'=>'Es obligatorio la descripcion del Rol'
        ];
    }
}