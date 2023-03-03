<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 *
 * @property int $id
 * @property int $product_id
 * @property int $inventory_id
 * @property string $street_address
 * @property string|null $apartment
 * @property string $city
 * @property string $state
 * @property string $country_code
 * @property string|null $zip
 * @property string $phone_number
 * @property string $email
 * @property string $name
 * @property string $order_status
 * @property string|null $payment_ref
 * @property string|null $transaction_id
 * @property int $payment_amt_cents
 * @property int $ship_charged_cents
 * @property int $ship_cost_cents
 * @property int $subtotal_cents
 * @property int $total_cents
 * @property string $shipper_name
 * @property Carbon $payment_date
 * @property Carbon $shipped_date
 * @property string $tracking_number
 * @property int $tax_total_cents
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Order extends Model
{
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'product_id' => 'int',
        'inventory_id' => 'int',
        'payment_amt_cents' => 'int',
        'ship_charged_cents' => 'int',
        'ship_cost_cents' => 'int',
        'subtotal_cents' => 'int',
        'total_cents' => 'int',
        'tax_total_cents' => 'int',
        'payment_date' => 'datetime',
        'shipped_date' => 'datetime'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'inventory_id',
        'street_address',
        'apartment',
        'city',
        'state',
        'country_code',
        'zip',
        'phone_number',
        'email',
        'name',
        'order_status',
        'payment_ref',
        'transaction_id',
        'payment_amt_cents',
        'ship_charged_cents',
        'ship_cost_cents',
        'subtotal_cents',
        'total_cents',
        'shipper_name',
        'payment_date',
        'shipped_date',
        'tracking_number',
        'tax_total_cents'
    ];
}
