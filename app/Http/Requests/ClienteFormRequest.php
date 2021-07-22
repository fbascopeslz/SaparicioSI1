<?php

namespace saparicio\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteFormRequest extends FormRequest
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
        //Persona
            'ci'=>'required',
            'nombre'=>'required|max:20',
            'paterno'=>'required|max:20',
            'materno'=>'max:20',
            'sexo'=>'required',
            'fechaNac'=>'',
            'telefono'=>'required',

            ////Cliente
            
            'tipo'=>'',
            //DIreccion
            'direccion'=>'required',
            'obs'=>'max:50',
            //ZOna
            'idZona'=>'required',
            'nombre'=>'max:40'


        ];
    }
}
