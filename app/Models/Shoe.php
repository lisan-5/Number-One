<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shoe extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'images', // up to 5 image URLs
        'size',
        'tags', // JSON array of tags
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'images' => 'array',
        'tags' => 'array',
    ];
    /**
     * Users who have wishlisted this shoe.
     */
    public function wishlistedBy()
    {
        return $this->hasMany(\App\Models\Wishlist::class);
    }
}
