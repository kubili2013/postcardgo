<?php

namespace App\Exceptions;

use Exception;

class PaypalException extends Exception
{
    public static function modelError(): self
    {
        return new static("Paypal mode can only be 'sandbox' Or 'live'.");
    }

}
