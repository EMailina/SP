<?php

namespace App\Controllers;

use App\Config\Configuration;
use App\Core\Responses\Response;
use App\Auth;
use App\Models\Registration;
use http\Client\Curl\User;


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

    public function updateProfileForm()
    {
        $found = Registration::getOne($_SESSION['id']);


        if ($found != null) {

            return $this->html(
                [
                    'error' => $this->request()->getValue('error'),
                    'success' => $this->request()->getValue('success'),
                    'profil' => $found
                ]
            );
        } else {
            $this->redirect('home');
        }

    }

    public function updatePasswordForm()
    {
        return $this->html(
            [
                'error' => $this->request()->getValue('error'),
                'success' => $this->request()->getValue('success')

            ]
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
        $registered = Auth::register($username, $password, $firstname, $lastname);

        if ($registered == true) {
            $this->redirect("portfolio", 'moje', ['successReg' => "Úspešne ste sa registrovali"]);
        } else {
            $this->redirect("auth", "registerForm", ['error' => "takyto login uz existuje"]);
        }

    }

    public function changeProfile()
    {
        if (Auth::isLogged()) {
            $username = $this->request()->getValue('username');
            $firstname = $this->request()->getValue('firstname');
            $lastname = $this->request()->getValue('surname');

            $hodnota = Auth::updateProfile($username, $firstname, $lastname);
            if ($hodnota === true) {
                $this->redirect("auth", "updateProfileForm", ['success' => "Vaše zmeny sa uložili"]);
            } else if ($hodnota === false) {
                $this->redirect("home");
            } else {
                $this->redirect("auth", "updateProfileForm", ['error' => $hodnota]);
            }
        }

    }

    public function deleteProfile()
    {
        if (!Auth::isLogged()) {
            $this->redirect('home');
        } else {

            $hodnota = Auth::deleteProfile();
            if ($hodnota === true) {
                $this->redirect('home');
            } else {
                $this->redirect('auth', 'updateProfileForm', ['error' => $hodnota]);
            }
        }
    }

    public function updatePassword()
    {
        if (!Auth::isLogged()) {
            $this->redirect('home');
        } else {
            $passwordOld = $this->request()->getValue('passwordOld');
            $passwordNew = $this->request()->getValue('password');
            $hodnota = Auth::updatePassword($passwordOld, $passwordNew);
            if ($hodnota === true) {
                $this->redirect("auth", "updatePasswordForm", ['success' => "Vaše zmeny sa uložili"]);
            } else {
                $this->redirect('auth', 'updatePasswordForm', ['error' => 'Vaše heslo sa nepodarilo zmeniť']);
            }
        }
    }

}