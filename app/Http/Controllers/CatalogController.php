<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function cart()
    {
        return view('cart', [
            'title' => 'Cart'
        ]);
    }

    public function wishlist()
    {
        $wishlist = Wishlist::where('user_id', auth()->user()->id)
            ->join('catalogs', 'catalogs.id', '=', 'wishlists.catalog_id')
            ->select('catalogs.*')
            ->get();
        return view('wishlist', [
            'title' => 'Wishlist',
            'wishlist' => $wishlist
        ]);
    }

    public function totalWishlist()
    {
        $count = Wishlist::where('user_id', auth()->user()->id)->count();
        // session(['wishlist_count' => $count]);
        return $count;
    }

    public function addWishlist(Request $request)
    {
        $countWishlist = Wishlist::countWishlist($request->catalog_id);
        if ($countWishlist == 0) {
            Wishlist::create([
                'user_id' => $request->user_id,
                'catalog_id' => $request->catalog_id
            ]);
            return response()->json([
                'alert' => 'add_wishlist',
                'text' => 'Produk berhasil ditambahkan ke wishlist!'
            ]);
        } else {
            Wishlist::where([
                'user_id' => auth()->user()->id,
                'catalog_id' => $request->catalog_id,
            ])->delete();
            return response()->json([
                'alert' => 'remove_wishlist',
                'text' => 'Produk berhasil dihapus dari wishlist!'
            ]);
        }
    }

    public function removeWishlist($id)
    {
        Wishlist::where([
            'user_id' => auth()->user()->id,
            'catalog_id' => $id,
        ])->delete();
        return back()
            ->with('alert', 'success')
            ->with('text', Catalog::where('id', $id)->first()->name . ' berhasil dihapus dari wishlist!');
    }

    public function detail($id)
    {
        if (!Catalog::get()->contains($id)) {
            return redirect('404');
        }
        $wishlist = Wishlist::countWishlist($id);
        $item = Catalog::where('id', $id)->first();
        return view('detail', [
            'title' => 'Product Detail',
            'item' => $item,
            'wishlist' => $wishlist
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'image' => ['image', 'file', 'max:5120', 'required'],
                'name' => ['min:3', 'max:50', 'required'],
                'description' => ['required'],
                'price' => ['numeric', 'required'],
            ],

            array(
                'image.required' => 'Gambar produk wajib dipilih.',
                'image.image' => 'File tidak didukung.',
                'name.required' => 'Nama produk harus diisi.',
                'name.min' => 'Nama produk minimal 3 karakter.',
                'name.max' => 'Nama produk maksimal 50 karakter.',
                'description.required' => 'Deskripsi produk harus diisi.',
                'price.numeric' => 'Harga produk harus berupa angka',
                'price.required' => 'Harga produk harus diisi',
            )
        );

        $image = str_pad(random_int(0, 9999999999), 15, '0', STR_PAD_LEFT) . '.' . $request->image->extension();

        $request->image->move(public_path('img/product'), $image);

        Catalog::create([
            'name' => $request->name,
            'image' => $image,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect('/admin/dashboard/catalog')
            ->with('alert', 'success')
            ->with('text', 'Item berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $item = Catalog::where('id', $id)->first();

        @unlink(public_path('/img/product/') . $item->image);

        $item->delete();

        return back()
            ->with('alert', 'success')
            ->with('text', $item->name . ' berhasil dihapus.');
    }

    public function indexUpdate($id)
    {
    }

    public function update($id)
    {
        $item = Catalog::where('id', $id)->first();

        @unlink(public_path('/img/product/') . $item->image);

        $item->delete();

        return back()
            ->with('alert', 'success')
            ->with('text', $item->name . ' berhasil dihapus.');
    }

    public function search(Request $request)
    {
        $keyword = $request->search;
        // dd($keyword);
        $result = Catalog::where('name', 'LIKE', "%$keyword%")
            ->orwhere('description', 'LIKE', "%$keyword%")
            ->orwhere('price', 'LIKE', "%$keyword%")
            ->get();
        if (strlen($keyword) == 0 || $keyword == null) {
            $keyword = '';
            $result = [];
        }
        return view('home', [
            'title' => 'Hasil pencarian untuk "' . $keyword . '"',
            'keyword' => $keyword,
            'result' => $result
        ]);
    }
}
