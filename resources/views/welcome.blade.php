@extends("layouts.app")

@section("title")
Selamat Datang
@endsection

@section("content")
<div class="container row">
    <div id="admin_login col">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Login Admin</h5>
                <hr />
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="username">{{ __('Username') }}</label>

                        <div>
                            <input id="username" type="text"
                                class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username"
                                value="{{ old('username') }}" required autofocus>

                            @if ($errors->has('username'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">{{ __('Password') }}</label>

                        <div>
                            <input id="password" type="password"
                                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                required>

                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col">
        <img src="{{ url('image/rsmb.png') }}" alt="rsmb" style="width: 110%;">
    </div>
</div>
@endsection
