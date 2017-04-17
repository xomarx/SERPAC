<?php

namespace App\Http\Requests\Configuracion;

use App\Http\Requests\Request;

class tipo_documentoCreateRequest extends Request
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
                        'recibo' => 'required|unique:tipo_documentos,tipo_documento',
                        'codigo' => 'required|unique:tipo_documentos,codigo',
                        'enlace' => 'required|unique:tipo_documentos,enlace'
                    ];
                }
            case 'PATCH':
            case 'PUT': {
                    return [
                        'recibo' => 'required',
                        'codigo' => 'required|exists:tipo_documentos,codigo',
                        'enlace' => 'required|unique:tipo_documentos,enlace'
                    ];
                }
            default : break;
        }
    }

    public function messages() {
        parent::messages();
        return [
            'recibo.unique'=>'El nombre del Recibo ya Existe',
            'codigo.unique'=>'El Codigo del Recibo ya Existe'
        ];
    }
        
}
