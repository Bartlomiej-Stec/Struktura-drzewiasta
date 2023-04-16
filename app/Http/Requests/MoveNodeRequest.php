<?php

namespace App\Http\Requests;

use App\Http\Requests\JsonRequest;
use App\Models\Tree;
use Illuminate\Validation\Rule;

class MoveNodeRequest extends JsonRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $parentId = $this->input('parent_id');
        $maxOrder = Tree::where('parent_id', $parentId)
            ->orWhereNull('parent_id')
            ->max('order');

        return [
            'node_id' => 'required|numeric|exists:tree,id',
            'order' => [
                'required',
                'numeric',
                'max:'.($maxOrder+1)
            ],
            'parent_id' => 'sometimes|nullable|exists:tree,id'
        ];
    }

    public function messages()
    {
        return [
            'order.max' => 'Nieprawidłowa pozycja węzła',
            'order.numeric' => 'Pozycja powinna być wartością liczbową',
            'node_id.required' => 'Wybierz węzeł do przeniesienia',
            'node_id.exists' => 'Wybrany węzeł nie istnieje',
            'parent_id' => 'Węzeł, do którego chcesz przenieść węzeł nie istnieje'
        ];
    }


}
