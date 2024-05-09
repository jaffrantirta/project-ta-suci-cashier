<?php

namespace App\Enums;

enum PaymentMethod: int
{
    case CASH = 1;
    case TRANSFER = 2;

    function toString()
    {
        return Str::title(Str::replace('_', ' ', Str::snake($this->name)));
    }

    //
    // PaymentMethod::from(3)->toString(); //Public Transportation
}
