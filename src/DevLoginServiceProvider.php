<?php

namespace NayThuKhant\LaravelDevLogin;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use NayThuKhant\LaravelDevLogin\Http\Components\DevLoginComponent;

class DevLoginServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/dev-login.php', 'dev-login'
        );

        if ($this->app->environment(config('dev-login.allowed_environments'))) {
            $this->publishes([
                __DIR__ . '/../config/dev-login.php' => config_path('dev-login.php'),
            ], 'dev-login');

            $this->loadViewsFrom(__DIR__ . '/../resources/views', 'dev-login');

            Blade::component('dev-login', DevLoginComponent::class);

            $this->registerRoutes();
            $this->getDataForLoop();

        }
    }

    public function register()
    {

    }

    private function getDataForLoop()
    {
        $guard = config('auth.defaults.guard') ?? config('dev-login.guard');
        $provider = config("auth.guards.{$guard}.provider");
        $model = config("auth.providers.{$provider}.model") ?? config('dev-login.auth_model');
        $column = config('dev-login.column_name');
        $foo = $model::all()->unique($column);
        $view = config('dev-login.view_path');

        view()->composer($view, function ($view) use ($foo) {
            $var_name = config('dev-login.var_name');
            $view->with("{$var_name}", $foo);
        });
    }
    private function registerRoutes()
    {
        $controller = config('dev-login.login_controller');
        Route::post('laravel-dev-login', $controller)->name('laravel-dev-login')->middleware(config('dev-login.middleware'));
    }
}
