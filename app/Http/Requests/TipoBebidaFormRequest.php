<?php

namespace saparicio\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoBebidaFormRequest extends FormRequest
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
          //  'idTipoBebida'=>'max:100',          
            'tipo'=>'max:30',
        ];
    }
}
