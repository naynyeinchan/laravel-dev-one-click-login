<?php

namespace NayThuKhant\LaravelDevLogin\Http\Controllers;

use App\Http\Controllers\Controller;
use NayThuKhant\LaravelDevLogin\Exceptions\AuthenticatableNotFound;
use NayThuKhant\LaravelDevLogin\Exceptions\InvalidAuthModel;
use NayThuKhant\LaravelDevLogin\Http\Requests\DevLoginRequest;

class DevLoginController extends Controller
{
    public function __invoke(DevLoginRequest $request)
    {
        $authenticatable = $this->getAuthenticatable($request);
        auth($request->guard)->login($authenticatable);
        return $this->redirect($request->redirect_url);
    }

    private function getAuthenticatable($request)
    {
        $authModel = $this->getAuthenticatableClass($request->guard);
        $identifierColumn = $request->identifier_column;

        /*If the dev provided identifier, the package will try to find it in the model of the given guard
        If not, the package will try to find very first row in the model of the given guard
        If none of them can't retrieve a record, the package will throw an exception
        */
        $authenticatable = $request->identifier ? $authModel::query()->where($identifierColumn, $request->identifier)->first() : $authModel::first();

        return $authenticatable ?? throw AuthenticatableNotFound::make();
    }

    private function getAuthenticatableClass($guard)
    {
        $provider = $guard === null
            ? config('auth.guards.web.provider')
            : config("auth.guards.{$guard}.provider");

        return config("auth.providers.{$provider}.model") ?? config('dev-login.auth_model') ?? throw InvalidAuthModel::make();
    }

    private function redirect($redirectUrl)
    {
        if ($redirectUrl) {
            $url = $redirectUrl;
        } else if ($routeName = config('dev-login.redirect_route_name')) {
            $url = route($routeName);
        } else {
            $url = '/';
        }

        return redirect()->to($url);
    }
}
