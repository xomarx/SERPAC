<?php

namespace App\Http\Requests\Tesoreria;

use App\Http\Requests\Request;

class MovDineroRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return  true;//auth()->user()->can(['crear movdinero']);
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
                    if($this->tipo == '')
            return [
                    'tipo' => 'required',
                    'comprobante' => 'required',
                    'numero' => 'required|numeric',
                    'fecha' => 'required|date',
                    'ruc' => 'required',
                    'razon' => 'required',
                    'direccion' => 'required',
                    'telefono' => 'required',
                    'concepto' => 'required',
                    'monto' => 'required|numeric'
                ];
        else if($this->tipo == 1)
            return [
                'tipo' => 'required',                
                'numero' => 'required|numeric',
                'fecha' => 'required|date',
                'ruc' => 'required',
                'razon' => 'required',                                
                'concepto' => 'required',
                'monto' => 'required|numeric'
            ];
    else{
        if($this->comprobante == 'FACTURA' || $this->comprobante == 'BOLETA')
            return [
                    'tipo' => 'required',
                    'comprobante' => 'required',
                    'numero' => 'required|numeric',
                    'fecha' => 'required|date',
                    'ruc' => 'required',
                    'razon' => 'required',
                    'direccion' => 'required',
                    'telefono' => 'required',
                    'concepto' => 'required',
                    'monto' => 'required|numeric'
                ]; 
            
        else              
            return [
                'tipo' => 'required',
                'comprobante' => 'required',
                'numero' => 'required|numeric',
                'fecha' => 'required|date',
                'ruc' => 'required',
                'razon' => 'required',                                
                'concepto' => 'required',
                'monto' => 'required|numeric'
            ];
        }
                }
            case 'PATCH':
            case 'PUT': {
                    return [
                        
                    ];
                }
            default : break;
        }
    }
}
