<?php
namespace Acme\Controllers;

use Acme\Models\User;
use Acme\Validation\Validator;
use Acme\Email\SendEmail;
use Acme\Models\UserPending;

class RegisterController extends BaseController
{
    public function getShowRegisterPage()
    {
        echo $this->blade->render("register", [
              'signer' => $this->signer,
          ]);
    }

    public function postShowRegisterPage()
    {
        if(!$this->signer->validateSignature($_POST['_token'])) {
            header('HTTP/1.0 400 Bad Request');
            exit;
        }

        $validation_data = [
          'first_name' => 'min:2|max:20',
          'last_name' => 'min:2|max:30',
          'email' => 'email|equalTo:verify_email|unique:User',
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
          echo $this->blade->render("register", [
                'signer' => $this->signer,
          ]);
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

        $token = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true));
        $user_pending = new UserPending;
        $user_pending->token = $token;
        $user_pending->user_id = $user->id;
        $user_pending->save();

        $message = $this->blade->render('emails.welcome-email',
            ['token' => $token]
        );

        SendEmail::sendEmail($user->email, "Welcome to Acme", $message);

        header("Location: /success");
        exit();
    }

    public function getVerifyAccount()
    {
        $user_id = 0;
        $token = $_GET['token'];

        // look up the token
        $user_pending = UserPending::where('token', '=', $token)->get();

        foreach ($user_pending as $item) {
            $user_id = $item->user_id;
        }

        if ($user_id > 0) {
            // make the user account active
            $user = User::find($user_id);
            $user->active = 1;
            $user->save();

            UserPending::where('token', '=', $token)->delete();

            header("Location: /account-activated");
            exit();
        } else {
            header("Location: /page-not-found");
            exit();
        }
    }
}
