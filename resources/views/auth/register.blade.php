@extends('app')

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="height: 70vh;">
        <div class="card" style="width: 30rem;">
            <div class="card-body">
                <h5 class="card-title text-center mb-4">Register</h5>

                <form method="POST" action="{{ route('register') }}" class="p-3">
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input id="name" class="form-control" type="text" name="name" :value="old('name')"
                            required autofocus autocomplete="name" />
                        @error('name')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input id="email" class="form-control" type="email" name="email" :value="old('email')"
                            required autocomplete="username" />
                        @error('email')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" class="form-control" type="password" name="password" required
                            autocomplete="new-password" />
                        @error('password')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation"
                            required autocomplete="new-password" />
                        @error('password_confirmation')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a class="text-decoration-none" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <button type="submit" class="btn btn-lg btn-hover-custom"
                            style="border-color: gray">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
