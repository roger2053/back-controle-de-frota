<?php

namespace App\Http\Requests\Stock;

use Illuminate\Foundation\Http\FormRequest;

class WithdrawnRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'quantity_withdrawn'=>'required',
            'destination_id'=>'required',
            'cpf'=>'required',
            'name'=>'required',
            'obs'=>'sometimes',
            'sign'=>'sometimes',
        ];
    }
}
