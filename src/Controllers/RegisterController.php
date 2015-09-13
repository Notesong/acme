<?php
namespace Acme\Controllers;

use Acme\Models\User;
use Acme\Validation\Validator;
use duncan3dc\Laravel\BladeInstance;

class RegisterController extends BaseController
{
    public function getShowRegisterPage()
    {
        //echo $this->twig->render('register.html');
        echo $this->blade->render("register");
    }

    public function postShowRegisterPage()
    {
      $validation_data = [
        'first_name' => 'min:2|max:20',
        'last_name' => 'min:2|max:30',
        'email' => 'email|equalTo:verify_email',
        'password' => 'min:6|max:15|equalTo:verify_password',
      ];

      // validate data
      $validator = new Validator;

      $errors = $validator->isValid($validation_data);

      // if validation fails, go back to register
      // page and display error message

      if (sizeof($errors) > 0)
      {
        $_SESSION['msg'] = $errors;
        echo $this->blade->render('register');
        unset($_SESSION['msg']);
        exit();
      }

      // save this data into a database
      $user = new User;
      $user->first_name = $_REQUEST['first_name'];
      $user->last_name = $_REQUEST['last_name'];
      $user->email = $_REQUEST['email'];
      $user->password = password_hash($_REQUEST['password'], PASSWORD_DEFAULT);
      $user->save();

      echo "Posted!";
    }
}
