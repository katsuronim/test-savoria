@extends('app')

@section('content')
    <div class="card my-4 mx-5 rounded-4 shadow-lg">
        <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('admin.apps-read') }}">Kelola Data
                        Aplikasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.map-apps-user') }}">Kelola Otorisasi Pengguna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.users-read') }}">Kelola Data Pengguna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.user-app-view') }}">List Data Akses Pengguna</a>
                </li>
            </ul>
            <div class="mx-auto" style="width: 60%">
                <h1 class="d-flex justify-content-center fs-4 mt-5 fw-bold">Ubah Data Aplikasi</h1>
                <form method="POST" action="{{ route('admin.apps-update', $apps->app_id) }}" class="p-3">
                    @csrf
                    @method('PATCH')

                    <!-- App Code -->
                    <div class="mb-3">
                        <label for="app_code" class="form-label">{{ __('Kode App') }}</label>
                        <input id="app_code" class="form-control" type="text" name="app_code"
                            value="{{ old('app_code', $apps->app_code) }}" required autofocus />
                        @error('app_code')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- App Name -->
                    <div class="mb-3">
                        <label for="app_name" class="form-label">{{ __('Nama App') }}</label>
                        <input id="app_name" class="form-control" type="text" name="app_name"
                            value="{{ old('app_name', $apps->app_name) }}" required autofocus />
                        @error('app_name')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- App Group -->
                    <div class="mb-3">
                        <label for="app_group" class="form-label">{{ __('Group App') }}</label>
                        <input id="app_group" class="form-control" type="text" name="app_group"
                            value="{{ old('app_group', $apps->app_group) }}" required autofocus />
                        @error('app_group')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- App URL -->
                    <div class="mb-3">
                        <label for="app_url" class="form-label">{{ __('URL App') }}</label>
                        <input id="app_url" class="form-control" type="text" name="app_url"
                            value="{{ old('app_url', $apps->app_url) }}" required autofocus />
                        @error('app_url')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="data_status" class="form-label">{{ __('Data Status') }}</label>
                        <select class="form-select" name="data_status" id="data_status">
                            <option disabled selected></option>
                            <option value="1" {{ old('data_status', $apps->data_status) == 1 ? 'selected' : '' }}>
                                Aktif</option>
                            <option value="0" {{ old('data_status', $apps->data_status) == 0 ? 'selected' : '' }}>
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
