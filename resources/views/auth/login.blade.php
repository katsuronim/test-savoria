@extends('app')

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="height: 70vh;">
        <div class="card rounded-4 shadow-lg" style="width: 35rem;">
            <div class="card-body">
                <h5 class="card-title text-center mb-4 fs-4">Login</h5>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="p-3">
                    @csrf

                    <!-- User Code -->
                    <div class="mb-3">
                        <label for="user_code" class="form-label">{{ __('User Code') }}</label>
                        <input id="user_code" class="form-control" type="text" name="user_code" :value="old('user_code')"
                            required autofocus />
                        @error('user_code')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" class="form-control" type="password" name="password" required
                            autocomplete="current-password" />
                        @error('password')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Show Password Checkbox -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="showPassword" onclick="togglePassword()">
                        <label class="form-check-label" for="showPassword">Show Password</label>
                    </div>

                    {{-- <!-- Remember Me -->
                    <div class="mb-3 form-check">
                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                        <label for="remember_me" class="form-check-label">{{ __('Remember me') }}</label>
                    </div> --}}

                    <div class="d-flex justify-content-end">
                        {{-- @if (Route::has('password.request'))
                            <a class="text-decoration-none my-auto" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif --}}

                        <button type="submit" class="btn btn-lg btn-hover-custom mt-2"
                            style="border-color: gray">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        function togglePassword() {
            var passwordInput = document.getElementById("password");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>
@endpush
