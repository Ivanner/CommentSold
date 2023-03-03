<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
/**
 * Class User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property bool $super_admin
 * @property bool $is_enabled
 * @property string $shop_name
 * @property string $card_brand
 * @property string $card_last_four
 * @property Carbon $trial_starts_at
 * @property Carbon $trial_ends_at
 * @property string $shop_domain
 * @property string $billing_plan
 *
 * @package App\Models
 */

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'super_admin',
        'is_enabled',
        'email_verified_at',
        'trial_ends_at',
        'trial_starts_at',
        'billing_plan',
        'shop_domain',
        'shop_name',
        'remember_token',
        'card_brand',
        'card_last_four',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'super_admin' => 'boolean',
        'is_enabled' => 'boolean',
        'email_verified_at' => 'datetime',
        'trial_ends_at' => 'datetime',
        'trial_starts_at' => 'datetime',
        'billing_plan' => 'string',
        'shop_domain' => 'string',
        'shop_name' => 'string',
        'remember_token' => 'string',
        'card_brand' => 'string',
        'card_last_four' => 'integer',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'admin_id');
    }
}
