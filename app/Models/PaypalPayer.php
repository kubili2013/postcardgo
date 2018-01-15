<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\ModelHelpers;

class PaypalPayer extends Model
{
    use ModelHelpers;
    const TABLE = 'paypel_payer';
    protected $table = 'paypal_payer';

    protected $fillable = [
        'email',
        'payer_id',
        'first_name',
        'last_name',
        'recipient_name',
        'shipping_address_line1',
        'shipping_address_city',
        'shipping_address_state',
        'postal_code',
        'country_code'
    ];
}
