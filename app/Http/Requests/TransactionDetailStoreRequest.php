<?php

namespace App\Http\Requests;

use App\Models\TransactionDetail;
use Illuminate\Foundation\Http\FormRequest;

class TransactionDetailStoreRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('create', TransactionDetail::class);
    }

    public function rules()
    {
        return [
            //
        ];
    }
}
