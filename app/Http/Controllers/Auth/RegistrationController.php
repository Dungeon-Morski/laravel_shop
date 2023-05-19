<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class RegistrationController extends Controller
{
    public function index()
    {
        return view('auth.registration');
    }

    public function store(Request $request)
    {

        $request->validate([
            'surname' => 'required|string',
            'name' => 'required|string',
            'patronymic' => 'string|nullable',
            'login' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|min:6',
        ]);

        $checkLogin = User::where('login', $request->login)->first();
        $checkEmail = User::where('email', $request->email)->first();

        if (!empty($checkLogin)) {
            return response()->json(['status' => 404, 'message' => 'Логин занят']);
        }
        if (!empty($checkEmail)) {
            return response()->json(['status' => 404, 'message' => 'Пользователь с такой почтой уже зарегистрирован']);
        }

        try {
            $user = User::create([
                'surname' => $request->surname,
                'name' => $request->name,
                'patronymic' => $request->patronymic,
                'login' => $request->login,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            Auth::login($user);
            return response()->json(['status' => 200, 'url' => route('products')]);
        } catch (\Throwable $e) {
            return response()->json(['status' => 404, 'message' => 'Логин или почта заняты']);

        }

    }
}
