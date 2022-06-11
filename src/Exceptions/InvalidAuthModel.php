<?php

namespace NayThuKhant\LaravelDevLogin\Exceptions;

use JetBrains\PhpStorm\Pure;

class InvalidAuthModel extends \Exception
{
    #[Pure] public static function make()
    {
        return new self('Could not find the auth model, make sure to specify valid auth_model in dev-login.php');
    }
}
