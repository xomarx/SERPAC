<?php

namespace App\Http\Requests\Tesoreria;

use App\Http\Requests\Request;

class MovChequeRequest extends Request
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
                        'cheque' => 'required',
                        'numero' => 'required|numeric|unique:mov_cheques,num_cheque',
                        'dato' => 'required|exists:personas,paterno,materno,nombre',
                        'concepto'=>'required',
                        'tipo'=>'required'
                    ];
                }
            case 'PATCH':
            case 'PUT': {
                    return [
                        //
                        'cheque' => 'required',
                        'numero' => 'required|numeric|unique:cheques,num_cuenta',
                        'dato' => 'required|exists:personas,paterno'.' '.'materno'.' '.'nombre',
                        'concepto'=>'required'
                    ];
                }
            default : break;
        }
    }
}
