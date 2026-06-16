<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category',
        'price',
        'description',
        'image_url',
        'is_active',
        'stock',
    ];

    public function getImageSrcAttribute()
    {
        if (!$this->image_url) {
            return asset('images/product/default.png');
        }

        if (Str::startsWith($this->image_url, ['http://', 'https://'])) {
            return $this->image_url;
        }

        return asset('storage/' . $this->image_url);
    }
}