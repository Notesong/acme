<?php
namespace Acme\Controllers;

use Acme\Models\User;
use Acme\Validation\Validator;
use duncan3dc\Laravel\BladeInstance;

class AuthenticationController extends BaseController
{
    public function getShowLoginPage()
    {
        //echo $this->twig->render('login.html');
        echo $this->blade->render("login");
    }

    public funtion postShowLoginPage()
    {

    }
}
