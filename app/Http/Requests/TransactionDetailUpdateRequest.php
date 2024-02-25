<?php

namespace App\Http\Requests;

use App\Models\TransactionDetail;
use Illuminate\Foundation\Http\FormRequest;

class TransactionDetailUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('update', $this->route('transactiondetail'));
    }

    public function rules()
    {
        return [
            //
        ];
    }
}
