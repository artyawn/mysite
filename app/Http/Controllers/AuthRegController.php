<?php


namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthRegController extends BaseController
{


    public function login(){
       if (Auth::check()){
          return redirect(route('task.index'));
    }
           return view('auth.login');
    }

    public function signin(Request $request){
        if(Auth::check()){
            return redirect(route('task.index'));
        }
        $data=$request->validate([
            'email'=>'required|string',
            'password'=>'required|string'
        ]);
       if (Auth::attempt($data)) {
          return redirect(route('task.index'));
       }
       else{return redirect(route('login'))->withErrors(['data'=>'Введены неверные данные']);}
    }


    public function reg(){
        if(Auth::check()){
           return redirect(route('task.index'));
        }
        return view('auth.register');
    }

    public function store(Request $request){
        if(Auth::check()){
            return redirect(route('task.index'));
        }
        $data=$request->validate([
            'name'=>'required|string',
            'email'=>'required|email',
            'password'=>'required|string'

        ]);

        if(User::where('name',$data['name'])->exists()){
           return redirect(route('register'))->withErrors([
                'name'=>'Пользователь с таким именем существует'
            ]);
        }

        if(User::where('email',$data['email'])->exists()){
            return redirect(route('register'))->withErrors([
                'email'=>'Пользователь с такой почтой существует'
            ]);
        }
        $user=User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]
        );
        if($user){
            Auth::login($user);
            return redirect(route('task.index'));
        }
        return redirect(route('register'))->withErrors([
            'data'=>'Произошла ошибка при регистрации пользователя'
        ]);

    }

    public function logout(){
        Auth::logout();
        return redirect(route('login'));
    }



}
