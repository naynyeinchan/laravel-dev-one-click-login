<?php

namespace NayThuKhant\LaravelDevLogin\Http\Components;

use Illuminate\View\Component;

class DevLoginComponent extends Component
{
    public function __construct(
        public ?string $identifierColumn = 'email',
        public ?string $identifier = null,
        public array   $userAttributes = [],
        public ?string $label = null,
        public ?string $redirectUrl = null,
        public ?string $guard  = null
    )
    {

    }

    public function render()
    {
        return view('dev-login::dev-login');
    }
}
