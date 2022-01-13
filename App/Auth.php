<?php

namespace App;

use App\Controllers\PortfolioController;
use App\Core\DB\Connection;
use App\Models\Comment;
use App\Models\Project;
use App\Models\Rating;
use App\Models\Registration;

class Auth
{

    public static function login($login, $password)
    {


        $found = Registration::getAll("username = ?", [$login]);
        if ($found != null) {
            foreach ($found as $user) {

                if (password_verify($password, $user->getPassword())) {
                    $_SESSION['id'] = $user->getId();
                    $_SESSION['name'] = $user->getUsername();
                    return true;
                }
            }
        } else {
            return false;
        }
    }

    public static function isLogged()
    {
        return isset($_SESSION['name']);
    }

    public static function getName()
    {
        return (Auth::isLogged() ? $_SESSION['name'] : "");
    }

    public static function logout()
    {
        unset($_SESSION['name']);
        unset($_SESSION['id']);
        session_destroy();
    }

    public static function register($username, $password, $firstname, $lastname)
    {
        if (Registration::getAll("username like ?", [$username]) == null && self::checkEmail($username)) {
            if ($username != null && $password != null && self::checkName($firstname) && self::checkName($lastname) && $firstname != null && $lastname != null) {

                $pass = password_hash($password, PASSWORD_DEFAULT);
                $newUser = new Registration(username: $username, firstname: $firstname, lastname: $lastname, password: $pass);
                $newUser->save();
                self::login($username, $password);
                return true;
            } else {


                return "Neplatné meno alebo priezvisko";
            }
        } else {
            return "Takyto email už existuje alebo máte neplatný formát";
        }
    }


    public static function deleteProfile()
    {
        if (Auth::isLogged()) {
            $found = Registration::getOne($_SESSION['id']);

            if ($found != null) {
                $id =
                $projects = Project::getAll("user_id = ?", [$_SESSION['id']]);

                foreach ($projects as $project) {
                    PortfolioController::deleteOneProject($project->getId());
                }

                //vymazanie jeho komentarov
                $comments = Comment::getAll("user_id like ?", [$_SESSION['id']]);

                foreach ($comments as $comment) {
                    $comment->delete();
                }

                //vymazanie jeho ratingov
                $ratings = Rating::getAll("user_id like ?", [$_SESSION['id']]);

                foreach ($ratings as $rating) {
                    $rating->delete();
                }
                Auth::logout();
                $found->delete();

                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    public
    static function updateProfile($username, $firstname, $lastname)
    {
        if (Auth::isLogged()) {
            $found = Registration::getOne($_SESSION['id']);

            if ($found != null) {
                if ($username == $_SESSION['name']) {
                    if ($username != null && self::checkName($firstname) && self::checkName($lastname) && $firstname != null && $lastname != null) {

                        $found->setFirstname($firstname);
                        $found->setLastname($lastname);

                        $found->save();

                        return true;
                    } else {
                        return 'Zadali ste nevhodnú hodnotu';
                    }
                } else {
                    if (Registration::getAll("username like ?", [$username]) == null
                        && $username != null && $firstname != null && self::checkName($firstname) && $lastname != null && self::checkName($lastname) && self::checkEmail($username)) {
                        $found->setFirstname($firstname);
                        $found->setLastname($lastname);
                        $found->setUsername($username);
                        $_SESSION['name'] = $username;
                        $found->save();
                        return true;
                    } else {
                        return 'Zadali ste použivaný alebo zlý email';
                    }
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public
    static function updatePassword($passwordOld, $passwordNew)
    {
        if (Auth::isLogged()) {
            $found = Registration::getOne($_SESSION['id']);

            if ($found != null) {
                if(self::checkPasswd($passwordNew)) {
                    if (password_verify($passwordOld, $found->getPassword())) {
                        $pass = password_hash($passwordNew, PASSWORD_DEFAULT);
                        $found->setPassword($pass);
                        $found->save();
                        return true;
                    }
                }else{
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public
    static function checkEmail($email)
    {
        if ($email != null) {
            $find1 = strpos($email, '@');
            $find2 = strpos($email, '.');
            return ($find1 !== false && $find2 !== false && $find2 > $find1);
        }
    }

    public
    static function checkName($name)
    {
        if ($name != null) {
            if (preg_match("/^[A-Z][a-z]*$/", $name)) {
                return true;
            }
        }
        return false;

    }

    static function checkPasswd($passwd)
    {
        if ($passwd != null) {
            if (preg_match("/^(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])*$/", $passwd)) {
                return true;
            }
        }
        return false;

    }
}