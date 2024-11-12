@extends('app')

@section('content')
    <div class="card my-4 mx-5 rounded-4 shadow-lg">
        <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.apps-read') }}">Kelola Data
                        Aplikasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.map-apps-user') }}">Kelola Otorisasi Pengguna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('admin.users-read') }}">Kelola Data
                        Pengguna</a>
                </li>
            </ul>
            <div class="mx-auto" style="width: 60%">
                <h1 class="d-flex justify-content-center fs-4 mt-5 fw-bold">Ubah Data Pengguna</h1>
                <form method="POST" action="{{ route('admin.users-update', $users->user_id) }}" class="p-3">
                    @csrf
                    @method('PATCH')

                    <!-- User Code -->
                    <div class="mb-3">
                        <label for="user_code" class="form-label">{{ __('Kode Pengguna') }}</label>
                        <input id="user_code" class="form-control" type="text" name="user_code"
                            value="{{ old('user_code', $users->user_code) }}" required autofocus />
                        @error('user_code')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- User Name -->
                    <div class="mb-3">
                        <label for="user_fullname" class="form-label">{{ __('Nama Pengguna') }}</label>
                        <input id="user_fullname" class="form-control" type="text" name="user_fullname"
                            value="{{ old('user_fullname', $users->user_fullname) }}" required autofocus />
                        @error('user_fullname')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Departemen -->
                    <div class="mb-3">
                        <label for="departement" class="form-label">{{ __('Departemen') }}</label>
                        <input id="departement" class="form-control" type="text" name="departement"
                            value="{{ old('departement', $users->departement) }}" required autofocus />
                        @error('departement')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="user_password" class="form-label">{{ __('Password') }}</label>
                        <input id="user_password" class="form-control" type="password" name="user_password"
                            value="{{ old('user_password') }}" required autofocus />
                        @error('user_password')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Show Password Checkbox -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="showPassword" onclick="togglePassword()">
                        <label class="form-check-label" for="showPassword">Show Password</label>
                    </div>

                    <div class="mb-3">
                        <label for="data_status" class="form-label">{{ __('Data Status') }}</label>
                        <select class="form-select" name="data_status" id="data_status">
                            <option disabled selected></option>
                            <option value="1" {{ old('data_status', $users->data_status) == 1 ? 'selected' : '' }}>
                                Aktif</option>
                            <option value="0" {{ old('data_status', $users->data_status) == 0 ? 'selected' : '' }}>
                                Tidak Aktif</option>
                        </select>
                        @error('data_status')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-lg btn-hover-custom mt-2"
                            style="border-color: gray">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        function togglePassword() {
            var passwordInput = document.getElementById("user_password");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>
@endpush
