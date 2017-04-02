<?php

namespace App\Http\Requests\RRHH;

use App\Http\Requests\Request;

class almacenCreateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can(['crear almacen','editar almacen']);
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
                        'sucursal' => 'required|unique:sucursales,sucursal',
                        'telefono' => 'required|numeric|min:9',
                        'fax' => 'required|numeric|min:9',
                        'direccion' => 'required',
                        'codigoId' => 'required|unique:sucursales,sucursalId',
                        'area' => 'required',
                        'departamento' => 'required',
                        'provincia' => 'required',
                        'distrito' => 'required',
                        'comite_central' => 'required',
                        'comite_local' => 'required',
                        'acopiador' => 'required'
                    ];
                }
            case 'PATCH':
            case 'PUT': {
                    return [
                        'sucursal' => 'required|unique:sucursales,sucursal',
                        'telefono' => 'required|numeric|min:9',
                        'fax' => 'required|numeric|min:9',
                        'direccion' => 'required',
                        'area' => 'required',
                        'departamento' => 'required',
                        'provincia' => 'required',
                        'distrito' => 'required',
                        'comite_central' => 'required',
                        'comite_local' => 'required',
                        'acopiador' => 'required'
                    ];
                }
            default : break;
        }
    }
    
    public function messages() {
        parent::messages();
        return [
            'departamento.required'=>'Seleccione un departamento',
            'provincia.required'=>'Seleccione un provincia',
            'distrito.required'=>'Seleccione un distrito',
            'comite_central.required'=>'Seleccione un comite central',
            'comite_local.required'=>'Seleccione un comite local',
            'sucursal.unique'=>'Ya existe el nombre de la Sucursal',
            'telefono.numeric'=>'Solo se permiten numeros',
            'fax.numeric'=>'Solo se permiten numeros',
            'direccion.required'=>'El campo direccion es Obligatorio',
            'codigoId.unique'=>'El Codigo ya existe',
            'area.required'=>'Seleccione una area',
            'acopiador.required'=>'Seleccione un Acopiador'
        ];
    }
}
