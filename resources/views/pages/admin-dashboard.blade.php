@extends('app')

@section('content')
    <div class="card my-4 mx-5 rounded-4 shadow-lg">
        <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.apps-read') }}">Kelola Data Aplikasi</a>
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
            <div class="d-flex flex-column align-items-center justify-content-center" style="height: 70vh">
                <div class="text-center" style="width: 50%;">
                    <h1 class="my-3 fs-1">Selamat Datang di Halaman Administrator</h1>
                    <p class="my-4 fs-5">Kelola hak akses aplikasi dengan mudah dan cepat. Di sini, setiap pengguna dapat
                        mengakses
                        aplikasi sesuai dengan hak akses yang telah diberikan. Sebagai admin, Anda dapat mengelola dan
                        mengatur
                        aplikasi serta
                        mengatur siapa yang dapat mengaksesnya. Mulai kelola akses aplikasi Anda sekarang!</p>
                </div>
            </div>
        </div>
    </div>
@endsection
