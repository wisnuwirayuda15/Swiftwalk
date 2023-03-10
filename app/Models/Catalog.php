<?php

namespace App\Models;

use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Catalog extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
}
