<?php

namespace saparicio\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ZonaEmpleadoFormRequest extends FormRequest
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
            'dias'=>'required|max:30',
            'ci'=>'',
            'idzona'=>'required'
        ];
    }

     public function messages()
    {
        return [
            'ci.unique' => 'El empleado ya tiene su respectiva zona, le aconsejamos  que visite la opcion editar',
            
        ];
    }
}
