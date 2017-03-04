<?php

namespace App\Http\Requests\socios;

use App\Http\Requests\Request;

class createfaunaRequest extends Request
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
            'fauna'=>'required|unique:faunas'
        ];
    }
    
    public function messages() {
        parent::messages();
       return ['fauna.unique'=>'El nombre ya Existe'];
    }
}
