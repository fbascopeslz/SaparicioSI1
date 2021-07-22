<?php

namespace saparicio\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProveedorFormRequest extends FormRequest
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
            'nombre'=>'required|max:30',
            'limiteCredito'=>'max:30',
            'debe'=>'max:10',
            'haber'=>'max:10',
            'estado'=>'max:10'
        ];
    }
}
