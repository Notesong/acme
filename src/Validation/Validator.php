<?php
namespace Acme\Validation;

use Respect\Validation\Validator as Valid;

class Validator
{
    public function isValid($validation_data)
    {
        $errors = [];

        foreach ($validation_data as $name => $value) {

            $rules = explode("|", $value);

            foreach ($rules as $rule) {
                $exploded = explode(":", $rule);

                switch ($exploded[0]) {
                  case 'min':
                    $min = $exploded[1];
                    if (Valid::string()->length($min, null)->Validate($_REQUEST[$name]) == false) {
                        $errors[] = $name . " must be at least " . $min . " characters long.";
                    }
                    break;

                  case 'max':
                    $max = $exploded[1];
                    if (Valid::string()->length(null, $max)->Validate($_REQUEST[$name]) == false) {
                        $errors[] = $name . " cannot be more than " . $max . " characters long.";
                    }
                    break;

                  case 'email':
                    if (Valid::email()->Validate($_REQUEST[$name]) == false) {
                        $errors[] = "Must be a valid email address.";
                    }
                    break;

                  case 'equalTo':
                    if (Valid::equals($_REQUEST[$name])->Validate($_REQUEST[$exploded[1]]) == false) {
                        $errors[] = "Values do not match.";
                    }
                    break;

                  // check to see if already exists in database
                  case 'unique':
                    $model = "Acme\\models\\" . $exploded[1];
                    $table = new $model;
                    $results = $table::where($name, '=', $_REQUEST[$name])->get();
                    foreach ($results as $item) {
                        $errors[] = $_REQUEST[$name] . " already exists in this system.";
                    }
                    break;

                  default:
                    $errors[] = "No value found.";
                }
            }
        }
        return $errors;
    }
}
