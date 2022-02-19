@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 mt-4">
                    <div class="card-header bg-white py-3">
                        <h4>Register for an Account</h4>
                    </div>
                    <div class="card-body">
                        <div class="p-4">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input id="nameId" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           placeholder="Your Name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label for="nameId">{{ __('Name') }}</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input id="emailId" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           placeholder="Email address"
                                           value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label for="emailId">{{ __('E-Mail Address') }}</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input id="passwordId" type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           name="password" placeholder="Enter your password" required
                                           autocomplete="new-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label for="passwordId">{{ __('Password') }}</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input id="password-confirmId" type="password" class="form-control"
                                           name="password_confirmation" placeholder="Confirm your password" required
                                           autocomplete="new-password">
                                    <label for="password-confirmId">{{ __('Confirm Password') }}</label>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
