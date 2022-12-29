<?php

namespace App\Models;

use App\Models\User;
use App\Models\Catalog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function catalog()
    {
        return $this->belongsTo(Catalog::class);
    }

    public static function countCart($catalog_id)
    {
        $countCart = Cart::where([
            'user_id' => auth()->user()->id,
            'catalog_id' => $catalog_id,
        ])->count();
        return $countCart;
    }
}
