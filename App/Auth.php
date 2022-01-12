<?php

namespace App;

use App\Core\DB\Connection;
use App\Models\Comment;
use App\Models\Project;
use App\Models\Rating;
use App\Models\Registration;

class Auth
{

    public static function login($login, $password)
    {
        //$pr = Connection::connect()->prepare('SELECT * FROM users WHERE username like ?');
        //$pr->execute([$login]);
        //$found = $pr->fetchAll();
        //$found = Registration::getAll('username like "' . $login . '"');
        // $found = Registration::getAll('username like "' . @0 . '"',$login);
        //$found = Registration::getAll(['username' => $login]);

        $found = Registration::getAll("username = ?", [ $login ]);
        if ($found != null) {
            foreach ($found as $user) {
                //if (password_verify($password, $user->getPassword())) {
                /*$_SESSION['id'] = $user->getId();
                $_SESSION['name'] = $user->getUsername();
                return true;
            }*/
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
        if (Registration::getAll('username like "' . $username . '"') == null && $username != null
            && $password != null && $firstname != null && $lastname != null) {
            $pass = password_hash($password, PASSWORD_DEFAULT);
            $newUser = new Registration(username: $username, firstname: $firstname, lastname: $lastname, password: $pass);
            $newUser->save();
            self::login($username, $password);
            return true;
        } else {
            return false;
        }
    }


    public static function deleteProfile()
    {
        if (Auth::isLogged()) {
            $found = Registration::getOne($_SESSION['id']);

            if ($found != null) {
                $projects = Project::getAll('user_id like "' . $_SESSION['id'] . '"');

                foreach ($projects as $project) {
                    Portfolio::deleteProject($project->getId());
                }

                //vymazanie jeho komentarov
                $comments = Comment::getAll('user_id like "' . $_SESSION['id'] . '"');

                foreach ($comments as $comment) {
                    $comment->delete();
                }

                //vymazanie jeho ratingov
                $ratings = Rating::getAll('id_user like "' . $_SESSION['id'] . '"');

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

    public static function updateProfile($username, $firstname, $lastname)
    {
        if (Auth::isLogged()) {
            $found = Registration::getOne($_SESSION['id']);

            if ($found != null) {
                if ($username == $_SESSION['name']) {
                    if ($username != null && $firstname != null && $lastname != null) {

                        $found->setFirstname($firstname);
                        $found->setLastname($lastname);

                        $found->save();

                        return true;
                    } else {
                        return 'Zadali ste nevhodnú hodnotu';
                    }
                } else {
                    if (Registration::getAll('username like "' . $username . '"') == null
                        && $username != null && $firstname != null && $lastname != null) {
                        $found->setFirstname($firstname);
                        $found->setLastname($lastname);
                        $found->setUsername($username);
                        $_SESSION['name'] = $username;
                        $found->save();
                        return true;
                    } else {
                        return 'Zadali ste pouzivaný email';
                    }
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function updatePassword($passwordOld, $passwordNew)
    {
        if (Auth::isLogged()) {
            $found = Registration::getOne($_SESSION['id']);

            if ($found != null) {
                if (password_verify($passwordOld, $found->getPassword())) {
                    $pass = password_hash($passwordNew, PASSWORD_DEFAULT);
                    $found->setPassword($pass);
                    $found->save();
                    return true;
                }

            } else {
                return false;
            }
        } else {
            return false;
        }
    }


}