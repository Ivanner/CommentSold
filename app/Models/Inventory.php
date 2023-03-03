<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

/**
 * Class Inventory
 *
 * @property int $id
 * @property int $product_id
 * @property int $quantity
 * @property string $color
 * @property string $size
 * @property float $weight
 * @property int $price_cents
 * @property int $sale_price_cents
 * @property int $cost_cents
 * @property string $sku
 * @property float $length
 * @property float $width
 * @property float $height
 * @property string $note
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Inventory extends Model
{

    use Sortable;

    /**
     * The attributes that we can sort by
     *
     * @var array<string, string>
     */
    public $sortable = [
        'id',
        'product_id',
        'quantity',
        'color',
        'size',
        'weight',
        'price_cents',
        'sale_price_cents',
        'cost_cents',
        'sku',
        'length',
        'width',
        'height',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'product_id' => 'int',
        'quantity' => 'int',
        'weight' => 'float',
        'price_cents' => 'int',
        'sale_price_cents' => 'int',
        'cost_cents' => 'int',
        'length' => 'float',
        'width' => 'float',
        'height' => 'float'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'quantity',
        'color',
        'size',
        'weight',
        'price_cents',
        'sale_price_cents',
        'cost_cents',
        'sku',
        'length',
        'width',
        'height',
        'note'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
