<?php

namespace NayThuKhant\LaravelDevLogin\Exceptions;

use JetBrains\PhpStorm\Pure;

class AuthenticatableNotFound extends \Exception
{
    #[Pure] public static function make()
    {
        return new self('Could not find the given identifier or there is no data in the table. Make sure you have put everything correctly in the component attributes.');
    }
}
