<?php

namespace App\Controllers;

use App\Config\Configuration;
use App\Core\Responses\Response;
use App\Auth;
use App\Models\Registration;


class AuthController extends AControllerRedirect
{
    public function index()
    {

    }

    public function loginForm()
    {
        return $this->html(['error' => $this->request()->getValue('error')]);
    }

    public function registerForm()
    {
        return $this->html(
            ['error' => $this->request()->getValue('error')]
        );
    }


    public function login()
    {
        $login = $this->request()->getValue('login');
        $password = $this->request()->getValue('password');

        $logged = Auth::login($login, $password);
        if ($logged) {
            $this->redirect('home');
        } else {
            $this->redirect('auth', 'loginForm', ['error' => 'zlé meno alebo heslo']);
        }

    }



    public function logout()
    {
        Auth::logout();
        $this->redirect('home');
    }

    public function register()
    {
        $username = $this->request()->getValue('username');
        $firstname = $this->request()->getValue('firstname');
        $lastname = $this->request()->getValue('surname');
        $password = $this->request()->getValue('password');
        $registered = Auth::register($username,$password,$firstname,$lastname);

        if ($registered == true) {
            $this->redirect("home");
        }else{
            $this->redirect("auth", "registerForm", ['error' => "takyto login uz existuje"]);
        }

    }


}