<?php

namespace App\Http\Requests;

use App\Models\Transaction;
use Illuminate\Foundation\Http\FormRequest;

class TransactionStoreRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('create', Transaction::class);
    }

    public function rules()
    {
        return [
            //
        ];
    }
}
