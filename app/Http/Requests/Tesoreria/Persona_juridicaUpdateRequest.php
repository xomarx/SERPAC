<?php

namespace App\Http\Requests\Tesoreria;

use App\Http\Requests\Request;

class Persona_juridicaUpdateRequest extends Request
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
            'ruc'=>'required|numeric|exists:persona_juridicas,ruc',
            'telefono'=>'required|numeric',
            'razon'=>'required|exists:persona_juridicas,razon_social',
            'direccion'=>'required'
        ];
    }
}
