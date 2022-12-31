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

    public static function soldCount($sold_data)
    {
        foreach ($sold_data as $catalog_id) {
            $item = Catalog::find($catalog_id);
            Catalog::where('id', $catalog_id)->update([
                'sold' => $item->sold += 1
            ]);
        }
    }
}
