<?php

namespace App\Http\Requests\socios;

use App\Http\Requests\Request;

class createCargo_directivorequest extends Request
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
                        'cargo_directivo' => 'required|unique:cargos_directivos'
                    ];
                }
            case 'PATCH':
            case 'PUT': {
                    return [
                        'cargo_directivo' => 'required'
                    ];
                }
            default : break;
        }
    }
    public function messages() {
        parent::messages();
        return ['cargo_directivo.unique'=>'El Cargo Directivo ya Existe'];
    }
}
