<?php

namespace App\Http\Requests\socios;

use App\Http\Requests\Request;

class createFlorarequest extends Request
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
            'flora'=>'required|unique:floras'
        ];
    }
    
    public function messages() {
        parent::messages();
        return ['flora.unique'=>'El nombre ya Existe'];
    }
}
