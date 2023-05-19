<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LogInController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function orderPlacement(Request $request)
    {

        $data = [
            'login' => Auth::user()->login,
            'password' => $request->password,
        ];


        if (!empty(Auth::attempt($data))) {

            $added = Order::orderCheckout(Auth::user()->id);

            if ($added != true) {
                return response()->json(['status' => 200, 'message' => 'Ошибка']);
            }

            return response()->json(['status' => 200, 'logged' => true,'url'=>route('order.index')]);
        }
        return response()->json(['status' => 200, 'logged' => false]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $checkUser = User::where('login', $data['login'])->first();

        if (!empty($checkUser)) {

            if (!Auth::attempt($data)) {
                throw ValidationException::withMessages([
                    'password' => 'Пароль введен неверно',
                ]);
            }

        }
        if (Auth::user()) {
            if (Auth::user()->is_admin == 1) {
                return redirect()->route('admin.index');
            }
            return redirect()->route('products');
        }


        throw ValidationException::withMessages([
            'login' => 'Пользователь не найден',
        ]);

        return redirect()->route('products');


    }
}
