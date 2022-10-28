@extends('layouts.app')

@section('title', 'Login/Register')

@section('content')
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                        <div>
                            <h4>Login</h4>
                            <form action="{{ route('login') }}" method="POST">
                                @csrf

                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="email">Email </label>
                                    <input name="email" type="email" id="email" class="form-control @error('email') is-invalid @enderror"  />
                                    @error('email')
                                        <small class="invalid-feedback" role="alert">{{ $message }}</small>                                    
                                    @enderror
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="loginPassword">Password</label>
                                    <input type="password" name="password" id="loginPassword" class="form-control @error('password') is-invalid @enderror"" />
                                    @error('password')
                                        <small class="invalid-feedback" role="alert">{{ $message }}</small>                                    
                                    @enderror
                                </div>

                                <!-- 2 column grid layout -->
                                <div class="row mb-4">
                                    <div class="col-md-6 d-flex">
                                        <!-- Checkbox -->
                                        <div class="form-check mb-3 mb-md-0">
                                            <input class="form-check-input" type="checkbox" value=""
                                            name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                                            <label class="form-check-label" for="loginCheck"> Remember me </label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 d-flex justify-content-center">
                                        <!-- Simple link -->
                                        <a href="{{ route('password.request') }}">Forgot password?</a>
                                    </div>
                                </div>

                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary btn-block mb-4 w-100">Sign in</button>
                            </form>
                        </div>>
                </div>
            </div>
        </div>
    </div>
@endsection
