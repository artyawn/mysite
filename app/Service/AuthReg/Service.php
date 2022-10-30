<?php


namespace App\Service\AuthReg;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Service
{
    public function store($data)
    {
        if (User::where('name', $data['name'])->exists()) {
            return redirect(route('register'))->withErrors([
                'name' => 'Пользователь с таким именем существует'
            ]);
        }

        if (User::where('email', $data['email'])->exists()) {
            return redirect(route('register'))->withErrors([
                'email' => 'Пользователь с такой почтой существует'
            ]);
        }
        $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]
        );
        if ($user) {
            Auth::login($user);
            return redirect(route('task.index'));
        }
    }

    public function signin($data)
    {
        if (Auth::attempt($data)) {
            return redirect(route('task.index'));
        }
    }
}
