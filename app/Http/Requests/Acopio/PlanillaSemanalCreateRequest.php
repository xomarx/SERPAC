<?php

namespace App\Http\Requests\Acopio;

use App\Http\Requests\Request;

class PlanillaSemanalCreateRequest extends Request
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
            //
            'almacen'=>'required|exists:sucursales,sucursalId',
            'planilla'=>'required|numeric',
            'lote'=>'required',
            'fecha'=>'required|date',
            'condicion'=>'required'
        ];
    }
    
    public function messages() {
        parent::messages();
        return [
            'almacen.exists'=>'El codigo del almacen no existe',
            'planilla.numeric'=>'Solo se permiten numeros',
            'planilla.required'=>'Es obligatorio el N° de la planilla',
            'condicion.required'=>'Seleccione una condicion'
        ];
    }
}
