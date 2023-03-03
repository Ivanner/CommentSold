<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

/**
 * Class Product
 *
 * @property int $id
 * @property string $product_name
 * @property string $description
 * @property string $style
 * @property string $brand
 * @property string $url
 * @property string $product_type
 * @property int $shipping_price
 * @property string|null $note
 * @property int|null $admin_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Product extends Model
{
    use Sortable;

    /**
     * The attributes that we can sort by
     *
     * @var array<string, string>
     */
    public $sortable = [
        'id',
        'product_name',
        'description',
        'style',
        'brand',
        'url',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'shipping_price' => 'int',
        'admin_id' => 'int'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_name',
        'description',
        'style',
        'brand',
        'url',
        'product_type',
        'shipping_price',
        'note',
        'admin_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function scopeIdDescending($query)
    {
        return $query->orderBy('id','DESC');
    }
}
