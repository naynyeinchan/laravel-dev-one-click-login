@env(config('dev-login.allowed_environments'))
    <form method="POST" action="{{ route('laravel-dev-login') }}">
        @csrf

        <input type="hidden" name="identifier" value="{{ $identifier }}">
        <input type="hidden" name="identifier_column" value="{{$identifierColumn}}">
        <input type="hidden" name="redirect_url" value="{{ $redirectUrl }}">
        <input type="hidden" name="guard" value="{{ $guard }}">

        <button class="{{ $attributes->has('class') ? $attributes->get('class') : 'underline' }}" type="submit">
            {{ $label ?? 'Laravel Dev Login' }}
        </button>
    </form>
@endenv
