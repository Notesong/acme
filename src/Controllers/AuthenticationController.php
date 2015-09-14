<?php
namespace Acme\Controllers;

use Acme\Models\User;
use Acme\Validation\Validator;
use duncan3dc\Laravel\BladeInstance;
use Acme\Auth\LoggedIn;

class AuthenticationController extends BaseController
{
    public function getShowLoginPage()
    {
        //echo $this->twig->render('login.html');
        echo $this->blade->render("login");
    }

    public function postShowLoginPage()
    {
        $okay = true;
        $activated = true;
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];

        // look up the user based on email
        $user = User::where('email', '=', $email)
            ->first();

        if ($user != null) {
            //validate credentials
            if (! password_verify($password, $user->password)) {
                $okay = false;
            }
        } else {
            $okay = false;
        }

        // if user is not yet activated through email link
        // deny access to account through flags
        if (($okay == true) && ($user->active == 0)) {
            $okay = false;
            $activated = false;
        }

        // if user is valid, log them in
        if($okay) {
            $_SESSION['user'] = $user;
            header("Location: /");
            exit();
        } else {
            // if user is not vaild, check to see if it's
            // because their account isn't activated
            if (!$activated){
                $_SESSION['msg'] = ["Invalid login.  You have not yet activated your account.  Please check your email."];
            } else {
                // if they don't have an account, activated
                // or not, let them know
                $_SESSION['msg'] = ["Invalid login."];
            }
            // if not valid for whatever reason, redirect
            // to login page and display appropriate
            // error message
            echo $this->blade->render('login');
            unset($_SESSION['msg']);
            exit();
        }
    }

    public function getLogout()
    {
        unset($_SESSION['user']);
        session_destroy();
        header("Location: /login");
        exit();
    }
}
