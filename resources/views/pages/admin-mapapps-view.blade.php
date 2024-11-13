@extends('app')

@section('content')
    <div class="card my-4 mx-5 rounded-4 shadow-lg">
        <div class="card-body">
            <!-- Nav Tabs -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.apps-read') }}">Kelola Data
                        Aplikasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.map-apps-user') }}">Kelola
                        Otorisasi Pengguna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.users-read') }}">Kelola Data Pengguna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('admin.user-app-view') }}">List Data Akses
                        Pengguna</a>
                </li>
            </ul>

            <div class="d-flex flex-column align-items-center mt-5 mb-4" style="height: 65vh">
                {{-- <div class="d-flex justify-content-between" style="width: 95%">
                    <div class="d-flex flex-column">
                        <form action="{{ route('admin.map-apps-user-search') }}" method="GET" class="d-flex">
                            <input type="text" name="keyword" placeholder="Cari..." class="form-control me-2">
                            <button type="submit" class="btn btn-outline-secondary">Cari</button>
                        </form>
                    </div>
                </div> --}}

                <table class="table table-striped table-hover" style="width: 95%">
                    <thead>
                        <tr>
                            <th class="">Kode App</th>
                            <th class="">Nama App</th>
                            <th class="">Kode Pengguna</th>
                            <th class="">Nama Pengguna</th>
                            <th class="">Tanggal Dibuat</th>
                            <th class="">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->app_code }}</td>
                                <td>{{ $item->app_name }}</td>
                                <td>{{ $item->user_code }}</td>
                                <td>{{ $item->user_name }}</td>
                                <td>{{ $item->granted_at }}</td>
                                <td>
                                    @if ($item->data_status == 1)
                                        Aktif
                                    @else
                                        Tidak Aktif
                                    @endif
                                </td>
                            </tr>
                            {{-- @empty
                            <tr>
                                @if ($maps->isEmpty() && request()->has('keyword'))
                                    <td colspan="10" class="py-5 text-center border border-slate-300">Data yang Anda cari
                                        tidak ditemukan.</td>
                                @endif
                            </tr> --}}
                        @endforeach
                    </tbody>
                </table>

                <ul class="pagination justify-content-end mt-4">
                    @if ($data->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link" aria-hidden="true">&laquo;</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $data->previousPageUrl() }}&keyword={{ request('keyword') }}"
                                aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    @endif

                    @foreach ($data->getUrlRange(1, $data->lastPage()) as $page => $url)
                        <li class="page-item {{ $data->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link"
                                href="{{ $url }}&keyword={{ request('keyword') }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    @if ($data->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $data->nextPageUrl() }}&keyword={{ request('keyword') }}"
                                aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link" aria-hidden="true">&raquo;</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
