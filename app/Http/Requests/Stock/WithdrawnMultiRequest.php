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
            'withdrawn' => 'required|array',
            'withdrawn.*.add_id' => 'required',
            'withdrawn.*.quantity_withdrawn' => 'required',
            'withdrawn.destination_id' => 'required',
            'withdrawn.cpf' => 'required',
            'withdrawn.name' => 'required',
            'withdrawn.obs' => 'sometimes',
            'withdrawn.sign' => 'sometimes',
        ];
    }
}
