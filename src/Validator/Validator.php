<?php

namespace App\Validator;

use Symfony\Component\Validator\Validator\ValidatorInterface;

class Validator
{
    private $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate($entity)
    {
        $errors = $this->validator->validate($entity);
            
        if (count($errors) > 0) {

            foreach ($errors as $error) {
                $errorsMessage[] = $error->getMessage();
            }

            return $errorsMessage;
        }

        return null;
    }
}