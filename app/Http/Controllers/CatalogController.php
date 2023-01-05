<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Catalog;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CatalogController extends Controller
{
    public function cart()
    {
        $cart = Cart::where('user_id', auth()->user()->id)
            ->join('catalogs', 'catalogs.id', '=', 'carts.catalog_id')
            ->select('catalogs.*')
            ->get();
        return view('cart', [
            'title' => 'Cart',
            'cart' => $cart,
            'sold_data' => [],
            'total_price' => 0,
            'total_item' => 0
        ]);
    }

    public function totalCart()
    {
        return Cart::where('user_id', auth()->user()->id)->count();
    }

    public function addCart(Request $request)
    {
        $countCart = Cart::countCart($request->catalog_id);
        if ($countCart == 0) {
            Cart::create([
                'user_id' => auth()->user()->id,
                'catalog_id' => $request->catalog_id
            ]);
            return response()->json([
                'alert' => 'add_cart',
                'text' => 'Produk berhasil ditambahkan ke keranjang!'
            ]);
        } else {
            Cart::where([
                'user_id' => auth()->user()->id,
                'catalog_id' => $request->catalog_id,
            ])->delete();
            return response()->json([
                'alert' => 'remove_cart',
                'text' => 'Produk berhasil dihapus dari keranjang!'
            ]);
        }
    }

    public function removeCart($id)
    {
        Cart::where([
            'user_id' => auth()->user()->id,
            'catalog_id' => $id,
        ])->delete();
        Session::forget('qty_cart' . $id);
        return back()
            ->with('alert', 'success')
            ->with('text', Catalog::where('id', $id)->first()->name . ' berhasil dihapus dari Keranjang!');
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
        return Wishlist::where('user_id', auth()->user()->id)->count();
    }

    public function addWishlist(Request $request)
    {
        $countWishlist = Wishlist::countWishlist($request->catalog_id);
        if ($countWishlist == 0) {
            Wishlist::create([
                'user_id' => auth()->user()->id,
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
        $cart = Cart::countCart($id);
        $item = Catalog::where('id', $id)->first();
        return view('detail', [
            'title' => 'Product Detail',
            'item' => $item,
            'wishlist' => $wishlist,
            'cart' => $cart,
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
        return redirect()->route('catalog')
            ->with('alert', 'success')
            ->with('text', 'Item berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $item = Catalog::where('id', $id)->first();
        @unlink(public_path('/img/product/') . $item->image);
        Wishlist::where('catalog_id', $id)->delete();
        Cart::where('catalog_id', $id)->delete();
        $item->delete();
        return back()
            ->with('alert', 'success')
            ->with('text', $item->name . ' berhasil dihapus.');
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => ['min:3', 'max:50', 'required'],
                'description' => ['required'],
                'price' => ['numeric', 'required'],
            ],
            array(
                'name.required' => 'Nama produk harus diisi.',
                'name.min' => 'Nama produk minimal 3 karakter.',
                'name.max' => 'Nama produk maksimal 50 karakter.',
                'description.required' => 'Deskripsi produk harus diisi.',
                'price.numeric' => 'Harga produk harus berupa angka',
                'price.required' => 'Harga produk harus diisi',
            )
        );
        $item = Catalog::find($id);
        $old_name = $item->name;
        if ($request->image) {
            $request->validate(
                ['image' => ['image', 'file', 'max:5120']],
                array('image.image' => 'File tidak didukung.')
            );
            @unlink(public_path('/img/product/') . $item->image);
            $image = str_pad(random_int(0, 9999999999), 15, '0', STR_PAD_LEFT) . '.' . $request->image->extension();
            $request->image->move(public_path('img/product'), $image);
        } else {
            $image = $item->image;
        }
        $item->update([
            'name' => $request->name,
            'image' => $image,
            'description' => $request->description,
            'price' => $request->price
        ]);
        return redirect()->route('catalog')
            ->with('alert', 'success')
            ->with('text', $old_name . ' berhasil diupdate.');
    }

    public function search(Request $request)
    {
        $keyword = $request->search;
        $title = 'Hasil pencarian untuk "' . $keyword . '"';
        $result = Catalog::where('name', 'LIKE', "%$keyword%")
            ->orwhere('description', 'LIKE', "%$keyword%")
            ->orwhere('price', 'LIKE', "%$keyword%")
            ->get();
        if (strlen($keyword) == 0 || $keyword == null) {
            $keyword = '';
            $result = [];
            $title = 'Anda tidak memasukan kata kunci apapun';
        }
        return view('home', [
            'title' => $title,
            'keyword' => $keyword,
            'result' => $result
        ]);
    }

    public function qtyCart(Request $request)
    {
        Session::put('qty_cart' . $request->cart_id, $request->qty);
        $total_price = 'Rp ' . number_format($request->qty * $request->price, 0, '', '.');
        return $total_price;
    }
}
