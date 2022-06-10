<?php

namespace Naythukhant\LaravelDevLogin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DevLoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'identifier' => '',
            'redirect_url' => '',
            'identifier_column' => '',
            'guard' => ''
        ];
    }
}
