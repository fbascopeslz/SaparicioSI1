<?php

namespace saparicio\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoFormRequest extends FormRequest
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
     *//*valida datos en un formulario*/
    public function rules()
    {
        return [
        'descripcion'=>'max:40',
        'precio'=>'required',
        'idsabor'=>'required',
        'idmedida'=>'required',
        'idpaquete'=>'required',
        'idmarca'=>'required',
        'idtipoEnvase'=>'required',
        'idtipoBebida'=>'required',
       'imagen'=>'mimes:jpeg,bmp,png',
        
        ];
    }
}
