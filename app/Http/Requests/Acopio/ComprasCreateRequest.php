<?php

namespace App\Http\Requests\Acopio;

use App\Http\Requests\Request;

class ComprasCreateRequest extends Request
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
            'acopio'=>'Required|exists:sucursales,sucursalId',
            'numero'=>'required|numeric',
            'paterno'=>'required_if:estado,NOSOCIO',
            'materno'=>'required_if:estado,NOSOCIO',
            'nombres'=>'required_if:estado,NOSOCIO',
            'dni'=>'required_if:estado,NOSOCIO|numeric|min:8',
            'comite'=>'required_if:estado,NOSOCIO',
            'codigo'=>'required_if:estado,SOCIO|exists:socios,codigo',
            'socio'=>'required_if:estado,SOCIO',
            'condicion'=>'required',
            'precio'=>'required|numeric',
            'kilos'=>'required|numeric',
            'fecha'=>'required',
            'codrecibo'=>'required|exists:tipo_documentos,codigo'
        ];
    }
    
    public function messages() {
        parent::messages();
        
        return [
            'codigo.exists'=>'El Codigo del Socio no Existe',
            'acopio.exists'=>'El Codigo no Existe',
            'acopio.required'=>'Ingrese el Codigo del Almacen',
            'paterno.required_if'=>'Es obligatorio su Apellido Paterno',
            'materno.required_if'=>'Es obligatorio su Apellido Materno',
            'nombres.required_if'=>'Es obligatorio su Nombre',
            'dni.required_if'=>'Es obligatorio su N° de D.N.I.',
            'comite.required_if'=>'Seleccione un Comite',
            'numero.numeric'=>'Solo se Permiten Numeros',
            'socios.required'=>'El Campo Socio es Obligatorio',
            'condicion.required'=>'Sleccione una Condicion',
            'precio.numeric'=>'Solo se permiten Numeros y punto',
            'kilos.numeric'=>'Solo se permiten Numeros y punto',
            'fecha.required'=>'Es obligatorio la Fecha',
            'codrecibo.exists'=>'El Codigo del Recibo no existe'
        ];
    }
}
