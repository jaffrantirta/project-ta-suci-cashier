<?php

namespace App\Http\Requests;

use App\Models\Item;
use Illuminate\Foundation\Http\FormRequest;

class ItemStoreRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('create', Item::class);
    }

    public function rules()
    {
        return [
            //
        ];
    }
}
