<?php

namespace App\Http\Requests;

use App\Models\ItemUnit;
use Illuminate\Foundation\Http\FormRequest;

class ItemUnitUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('update', $this->route('itemunit'));
    }

    public function rules()
    {
        return [
            'name' => ['required', 'min:3'],
        ];
    }
}
