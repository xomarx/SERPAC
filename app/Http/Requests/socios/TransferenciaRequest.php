<?php

namespace App\Http\Requests\Socios;

use App\Http\Requests\Request;

class TransferenciaRequest extends Request
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
                        'codigo'=>'required',
                        'motivo'=>'required',
                        'dni_socio'=>'required',
                        'dni_nuevo_socio'=>'required',
                        'dni_beneficiario'=>'required',
                        'socio'=>'required'
                    ];
                }
            case 'PATCH':
            case 'PUT':                
            default : break;
        }
    }        
}
