<?php


namespace App\Http\Controllers;


use App\Http\Requests\AuthReg\StoreRequest;
use App\Models\User;
use App\Service\AuthReg\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthRegController extends Controller
{


    public function login()
    {
        if (Auth::check()) {
            return redirect(route('task.index'));
        }
        return view('auth.login');
    }

    public function signin(Service $service, Request $request)
    {
        if (Auth::check()) {
            return redirect(route('task.index'));
        }
        $data = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        $service->signin($data);
        return redirect(route('login'))->withErrors(['data' => 'Введены неверные данные']);
    }


    public function reg()
    {
        if (Auth::check()) {
            return redirect(route('task.index'));
        }
        return view('auth.register');
    }

    public function store(Service $service, StoreRequest $request)
    {
        if (Auth::check()) {
            return redirect(route('task.index'));
        }
        $data = $request->validated();
        return $service->store($data);

    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }


}
