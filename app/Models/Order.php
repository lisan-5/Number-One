<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'delivery',
        'location',
        'instructions',
        'items',
        'subtotal',
        'total',
        'status',
        'size',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'delivery' => 'boolean',
        'items' => 'array',
        'subtotal' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    /**
     * The user who placed the order.
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
