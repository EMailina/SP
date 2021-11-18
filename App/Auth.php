<?php

namespace App;

use App\Models\Registration;

class Auth
{


    public static function login($login, $password)
    {
        $found= Registration::getAll('username like "'.$login.'" AND password like "'.$password.'"');
        if($found != null){
            foreach ($found as $user) {
                $_SESSION['id'] = $user->getId();
                $_SESSION['name'] = $user->getUsername();
            }
            return true;
        }else{
            return false;
        }
    }

    public static function isLogged(){
        return isset($_SESSION['name']);
    }

    public static function getName(){
        return (Auth::isLogged() ? $_SESSION['name']: "");
    }

    public static function logout(){
        unset($_SESSION['name']);
        session_destroy();
    }

    public static function register($username, $password, $firstname, $lastname){

        if (Registration::getAll('username like "' . $username . '"') == null &&  $username != null
            && $password != null && $firstname != null && $lastname != null) {

            $newUser = new Registration(username: $username, firstname: $firstname, lastname: $lastname, password: $password);
            $newUser->save();
            self::login($username,$password);
            return true;
        }else {
            return false;
        }
    }
}