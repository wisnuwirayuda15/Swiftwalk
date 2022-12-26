<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Catalog;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index()
    {
        return view('dashboard.index', [
            'title' => 'Dashboard',
            'users' => User::get(),
            'catalogs' => Catalog::get()
        ]);
    }


    public function indexCatalog()
    {
        return view('dashboard.catalog', [
            'title' => 'Catalog',
            'catalogs' => Catalog::get()
        ]);
    }

    public function indexAddItem()
    {
        return view('dashboard.add-item', [
            'title' => 'Add Item'
        ]);
    }

    public function indexUsers()
    {
        return view('dashboard.users', [
            'title' => 'Manage Users',
            'users' => User::get()
        ]);
    }

    public function updateRole(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        $username = $user->username;
        $is_admin = $request->is_admin == 'Admin' ? true : false;
        if ($user->id == auth()->user()->id) {
            return back()
                ->with('alert', 'warning')
                ->with('text', 'Anda tidak dapat merubah role anda sendiri.');
        } else if ($user->email == 'wisnuwirayuda15@gmail.com') {
            return back()
                ->with('alert', 'warning')
                ->with('text', 'Role gua jangan diganti dong, ntar siapa yang ngurus webnya wkwkwkwkkw.');
        }
        User::where('id', $id)->update([
            'is_admin' => $is_admin
        ]);
        return back()
            ->with('alert', 'info')
            ->with('text', 'Role ' . $username . ' sekarang adalah ' . $request->is_admin . '.');
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)->first();
        if ($user->id == auth()->user()->id) {
            return back()
                ->with('alert', 'info')
                ->with('text', 'Anda tidak dapat menghapus akun anda sendiri di sini, silahkan ke menu profile untuk menghapus akun anda.');
        } else if ($user->email == 'wisnuwirayuda15@gmail.com') {
            return back()
                ->with('alert', 'warning')
                ->with('text', 'Hayolo mau ngapus akun gua?? wkwkwkwkwk.');
        }
        $username = $user->username;
        @unlink(public_path('/img/avatar/') . $user->avatar);
        $user->delete();
        return back()
            ->with('alert', 'success')
            ->with('text', 'Akun ' . $username . ' berhasil dihapus');
    }
}
