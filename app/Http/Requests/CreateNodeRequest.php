<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;

class CreateNodeRequest extends JsonRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|regex:/^[a-zA-Z0-9]{' . config('tree.node_minlength') . ',' . config('tree.node_maxlength') . '}$/',
            'parent_id' => 'sometimes|nullable|exists:tree,id'
        ];
    }

    public function messages()
    {
        return [
            'name.regex' => 'Nazwa węzła może zawierać jedynie litery, cyfry i musi być odpowiedniej długości.',
            'parent_id.exists' => 'Wybrany węzeł nie istnieje',
            'name.required' => 'Nazwa węzła jest wymagana'
        ];
    }
}
