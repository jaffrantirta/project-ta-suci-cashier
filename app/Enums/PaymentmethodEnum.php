<?php

namespace App\Enums;

enum Paymentmethod: int
{
    case CASH = 1;

    function toString()
    {
        return Str::title(Str::replace('_', ' ', Str::snake($this->name)));
    }

    //
    // PaymentMethod::from(3)->toString(); //Public Transportation
}
