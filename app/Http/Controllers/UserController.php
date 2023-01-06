<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\Array_;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Auth\UserProvider;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexLogin()
    {
        return view('login-register', [
            'title' => 'Login',
            'page' => 'login',
        ]);
    }

    public function indexRegister()
    {
        return view('login-register', [
            'title' => 'Daftar',
            'page' => 'register',
        ]);
    }

    public function profile()
    {
        $date_created = Carbon::parse(auth()->user()->created_at)
            ->format('d F Y');
        $acc_age = Carbon::parse(auth()->user()->created_at)
            ->diff(Carbon::now())
            ->format('%y tahun, %m bulan, %d hari');
        return view('profile', [
            'title' => 'Profile',
            'acc_age' => $acc_age,
            'date_created' => $date_created,
        ]);
    }

    public function login(Request $request)
    {
        $remember = ($request->remember == 'on' ? true : false);
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/')
                ->with('alert', 'info')
                ->with('text', 'Selamat datang, ' . auth()->user()->username . '!');
        };
        return back()
            ->with('alert', 'error')
            ->with('text', 'Email atau password salah!');
    }

    public function register(Request $request)
    {
        $userData = $request->validate(
            [
                'email' => ['unique:users'],
                'username' => ['min:3', 'max:20'],
                'gender' => ['required'],
                'number' => ['numeric'],
                'password' => ['min:8', 'same:password_confirmation']
            ],
            $messages = array(
                'password.same' => 'Konfirmasi password tidak sesuai.',
                'number.numeric' => 'Nomor hp harus berupa angka.',
                'password.min' => 'Password minimal 8 karakter.',
                'password.same' => 'Konfirmasi password tidak sesuai.',
                'username.min' => 'Username minimal 3 karakter.',
                'username.max' => 'Username maksimal 20 karakter.',
                'email.unique' => 'Email sudah digunakan.',
                'email.email' => 'Masukan email yang benar.'
            )
        );
        $userData['password'] = bcrypt($userData['password']);
        User::create($userData);
        return redirect('/login')
            ->with('alert', 'success')
            ->with('text', 'Registrasi berhasil, sekarang anda bisa login!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        session()->flush();
        return redirect('/')
            ->with('alert', 'success')
            ->with('text', 'Anda berhasil logout!');
    }

    public function update(Request $request, $name)
    {
        $data = $request->$name;
        if ($name == 'username') {
            $request->validate(
                [
                    'username' => ['min:3', 'max:20']
                ],
                array(
                    'username.min' => 'Username minimal 3 karakter.',
                    'username.max' => 'Username maksimal 20 karakter.'
                )
            );
        } elseif ($name == 'avatar') {
            $request->validate(
                [
                    'avatar' => ['image', 'file', 'max:2048']
                ],
                array(
                    'avatar.max' => 'Ukuran file maksimal 2Mb.',
                    'avatar.image' => 'File tidak didukung.'
                )
            );
            if ($request->avatar) {
                @unlink(public_path('/img/avatar/') . auth()->user()->avatar);
                $data = auth()->user()->username . '-' . str_pad(random_int(0, 9999999999), 10, '0', STR_PAD_LEFT) . '.' . $request->avatar->extension();
                $request->avatar->move(public_path('img/avatar'), $data);
            } else {
                $data = $request->avatar;
            }
        } elseif ($name == 'number') {
            $request->validate(
                [
                    'number' => ['numeric']
                ],
                $messages = array(
                    'number.numeric' => 'Nomor hp harus berupa angka.'
                )
            );
        } elseif ($name == 'password') {
            $credentials = [
                'email' => auth()->user()->email,
                'password' => $request->old_password,
            ];
            if (Auth::attempt($credentials)) {
                $request->validate(
                    [
                        'password' => ['min:8', 'same:password_confirmation']
                    ],
                    $messages = array(
                        'password.min' => 'Password minimal 8 karakter.',
                        'password.same' => 'Konfirmasi password tidak sesuai.',
                    )
                );
                $data = bcrypt($data);
            } else {
                return back()
                    ->with('alert', 'error')
                    ->with('text', 'Password lama anda salah!');
            };
        }
        User::where('id', auth()->user()->id)->update([
            $name => $data
        ]);
        $request->session()->regenerate();
        return back()
            ->with('alert', 'success')
            ->with('text', 'Data berhasil diupdate!');
    }

    public function removeAvatar()
    {
        User::where('id', auth()->user()->id)->update([
            'avatar' => null
        ]);
        @unlink(public_path('/img/avatar/') . auth()->user()->avatar);
        return back()
            ->with('alert', 'success')
            ->with('text', 'Avatar berhasil dihapus!');
    }

    public function destroy()
    {
        @unlink(public_path('/img/avatar/') . auth()->user()->avatar);
        User::find(auth()->user()->id)->delete();
        return redirect('/')
            ->with('alert', 'success')
            ->with('text', 'Akun anda berhasil dihapus');
    }

    public function checkoutVerify(Request $request)
    {
        $credentials = [
            'email' => auth()->user()->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($credentials)) {
            CatalogController::inputSoldCount($request->sold_data);
            $total_price = 'Rp ' . number_format($request->total_price, 0, '', '.') . ',-';
            return back()
                ->with('alert', 'success')
                ->with('text', 'Transaksi anda berhasil!\nTotal belanjamu senilai: ' . $total_price);
        } else {
            return back()
                ->with('alert', 'error')
                ->with('text', 'Password anda salah!');
        };
    }
}
