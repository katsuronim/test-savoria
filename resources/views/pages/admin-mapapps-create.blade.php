@extends('app')

@section('content')
    <div class="card my-4 mx-5 rounded-4 shadow-lg">
        <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.apps-read') }}">Kelola Data Aplikasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('admin.map-apps-user') }}">Kelola
                        Otorisasi Pengguna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.users-read') }}">Kelola Data Pengguna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.user-app-view') }}">List Data Akses Pengguna</a>
                </li>
            </ul>
            <div class="mx-auto" style="width: 60%">
                <h1 class="d-flex justify-content-center fs-4 mt-5 fw-bold">Tambah Data Hak Akses Pengguna</h1>
                <form method="POST" action="{{ route('admin.map-apps-user-store') }}">
                    @csrf

                    {{-- Apps as Checkboxes --}}
                    <div class="mb-3">
                        <label class="form-label">{{ __('Pilih Aplikasi') }}</label>
                        <div class="form-check" style="max-height: 200px; overflow-y: auto; border: 1px solid #ced4da;">
                            @foreach ($apps as $item)
                                <div class="d-flex align-items-center ms-3"> <!-- Added margin to each item container -->
                                    <input class="form-check-input" type="checkbox" name="app_ids[]"
                                        value="{{ $item->app_id }}" id="app_{{ $item->app_id }}">
                                    <label class="form-check-label ms-2" for="app_{{ $item->app_id }}">
                                        {{ $item->app_code }} - {{ $item->app_name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('app_ids')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- User as Dropdown --}}
                    <div class="mb-3">
                        <label for="user_id" class="form-label">{{ __('Pengguna') }}</label>
                        <select class="form-select" name="user_id" id="user_id" required>
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

                    {{-- Data Status --}}
                    <div class="mb-3">
                        <label for="data_status" class="form-label">{{ __('Data Status') }}</label>
                        <select class="form-select" name="data_status" id="data_status" required>
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
