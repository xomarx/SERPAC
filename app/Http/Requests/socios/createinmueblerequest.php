<?php

namespace App\Http\Requests\socios;

use App\Http\Requests\Request;

class createinmueblerequest extends Request
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
                        'inmueble' => 'required|unique:inmuebles'
                    ];
                }
            case 'PATCH':
            case 'PUT': {
                    return [
                        //
                        'inmueble' => 'required'
                    ];
                }
            default : break;
        }
    }
    public function messages() {
        parent::messages();
        return ['inmueble.unique'=>'El nombre de el inmueble ya existe'];
    }
}
