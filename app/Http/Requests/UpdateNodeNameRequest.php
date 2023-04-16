<?php

namespace App\Http\Requests;

use \App\Http\Requests\JsonRequest;

class UpdateNodeNameRequest extends JsonRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|regex:/^[a-zA-Z0-9]{' . config('tree.node_minlength') . ',' . config('tree.node_maxlength') . '}$/',
            'node_id' => 'required|numeric|exists:tree,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nazwa węzła jest wymagana',
            'name.regex' => 'Nazwa węzła może zawierać jedynie litery, cyfry i musi być odpowiedniej długości.',
            'node_id.required' => 'Wybierz węzeł, któremu chcesz zmienić nazwę',
            'node_id.exists' => 'Wybrany węzeł nie istnieje',
            'node_id.numeric' => 'ID węzła powinno być wartością liczbową'
        ];
    }
}
