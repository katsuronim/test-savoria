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
                    <a class="nav-link active" aria-current="page" href="{{ route('admin.map-apps-user') }}">Kelola
                        Otorisasi Pengguna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.users-read') }}">Kelola Data Pengguna</a>
                </li>
            </ul>
            <div class="mx-auto" style="width: 60%">
                <h1 class="d-flex justify-content-center fs-4 mt-5 fw-bold">Tambah Data Hak Akses Pengguna</h1>
                <form method="POST" action="{{ route('admin.map-apps-user-store') }}">
                    @csrf

                    {{-- App --}}
                    <div class="mb-3">
                        <label for="app_id" class="form-label">{{ __('Aplikasi') }}</label>
                        <select class="form-select" name="app_id" id="app_id">
                            <option disabled selected></option>
                            @foreach ($apps as $item)
                                <option value="{{ $item->app_id }}">{{ $item->app_code }} - {{ $item->app_name }}</option>
                            @endforeach
                        </select>
                        @error('app_id')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- User --}}
                    <div class="mb-3">
                        <label for="user_id" class="form-label">{{ __('Pengguna') }}</label>
                        <select class="form-select" name="user_id" id="user_id">
                            <option disabled selected></option>
                            @foreach ($users as $item)
                                <option value="{{ $item->user_id }}">{{ $item->user_code }} - {{ $item->user_fullname }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label for="data_status" class="form-label">{{ __('Data Status') }}</label>
                        <select class="form-select" name="data_status" id="data_status">
                            <option disabled selected></option>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
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
@endpush
