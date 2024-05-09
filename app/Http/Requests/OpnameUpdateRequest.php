<?php

namespace App\Http\Requests;

use App\Models\Opname;
use Illuminate\Foundation\Http\FormRequest;

class OpnameUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('update', $this->route('opname'));
    }

    public function rules()
    {
        return [
            //
        ];
    }
}
