<?php
namespace Acme\controllers;

use duncan3dc\Larave\BladeInstance;
use Acme\Models\Testimonial;
use Acme\Validation\Validator;
use Acme\auth\LoggedIn;

class TestimonialController extends BaseController
{
    public function getTestimonials()
    {
        $testimonials = Testimonial::all();

        echo $this->blade->render('testimonials', [
            'testimonials' => $testimonials,
        ]);
    }

    public function getShowAdd()
    {
        echo $this->blade->render('add-testimonial', [
              'signer' => $this->signer,
          ]);
    }

    public function postShowAdd()
    {
        if(!$this->signer->validateSignature($_POST['_token'])) {
            header('HTTP/1.0 400 Bad Request');
            exit;
        }

        $validation_data = [
          'title' => 'min:3|max:30',
          'testimonial' => 'min:10|max:5000',
        ];

        // validate data
        $validator = new Validator;

        $errors = $validator->isValid($validation_data);

        // if validation fails, go back to register
        // page and display error message

        if (sizeof($errors) > 0)
        {
          $_SESSION['msg'] = $errors;
          echo $this->blade->render('add-testimonial', [
                'signer' => $this->signer,
            ]);
          unset($_SESSION['msg']);
          exit();
        }

        $testimonial = new Testimonial;
        $testimonial->title = $_REQUEST['title'];
        $testimonial->testimonial = $_REQUEST['testimonial'];
        $testimonial->user_id = LoggedIn::user()->id;
        $testimonial->save();

        header("Location: /testimonial-saved");
        exit();
    }
}
