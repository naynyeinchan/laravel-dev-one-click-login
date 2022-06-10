<?php

namespace Naythukhant\LaravelDevLogin\Exceptions;

class InvalidAuthModel extends \Exception
{
    public static function make()
    {
        return new self('Could not find the auth model, make sure to specify valid auth_model in dev-login.php');
    }
}
