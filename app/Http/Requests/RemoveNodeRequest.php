<?php

namespace App\Http\Requests;

use App\Http\Requests\JsonRequest;

class RemoveNodeRequest extends JsonRequest
{
    public function rules()
    {
        return [
            'node_id' => 'required|numeric|exists:tree,id',
            'removing_type' => 'required|in:' . implode(',', config('tree.removing_types')),
        ];
    }

    public function messages()
    {
        return [
            'node_id.exists' => 'Wybrany węzeł nie istnieje',
            'node_id.required' => 'Wybierz węzeł, który chcesz usunąć',
            'node_id.numeric' => 'Wybierz prawidłowy węzeł',
            'removing_type.required' => 'Wymagane są wszyskie pola',
            'removing_type.in' => 'Nieprawidłowy typ usunięcia węzła',
        ];
    }
}
