<?php


namespace App\Service\AuthReg;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Service
{
    public function store($data)
    {
        $email=null;
        $name=null;
        if (User::where('name', $data['name'])->exists()) {
            $name = 'Пользователь с таким именем уже существует';
        }

        if (User::where('email', $data['email'])->exists()) {
            $email = 'Пользователь с такой почтой существует';
        }
        if (isset($name) || isset($email)) {
            return redirect(route('register',$data))->withErrors([
                'email' => $email,
                'name' => $name]);
        } else {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            if ($user) {
                Auth::login($user);
                return redirect(route('task.index'));
            } else {
                return redirect(route('register'))->withErrors([
                    'data' => 'Произошла ошибка при регистрации пользователя']);
            }
        }
    }

    public function signin($data)
    {
        if (Auth::attempt($data)) {
            return redirect(route('task.index'));
        }
    }
}
