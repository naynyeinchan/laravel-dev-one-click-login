<?php



/*all the config are not getting from Env helper since this application should not be messing up the env file*/


use NayThuKhant\LaravelDevLogin\Http\Controllers\DevLoginController;

return [
    /*default route name to be redirected after logging in*/
    "redirect_route_name" => null,

    /*controller for handling the request,
     invoke function of this controller will be called by default*/
    "login_controller" => DevLoginController::class,

    /*default guard for authentication
    this guard is really important because it works together with application authentication config*/
    "guard" => "web",

    /*default model to authenticate*/
    "auth_model" => null,

    /*this middleware will be applied for the dev login route*/
    "middleware" => 'web',

    /*this will define when to include things provided by this package*/
    "allowed_environments" => ['local']
];
