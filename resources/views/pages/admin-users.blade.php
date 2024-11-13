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
                    <a class="nav-link" href="{{ route('admin.map-apps-user') }}">Kelola Otorisasi Pengguna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('admin.users-read') }}">Kelola Data
                        Pengguna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.user-app-view') }}">List Data Akses Pengguna</a>
                </li>
            </ul>

            <div class="d-flex flex-column align-items-center mt-5 mb-4" style="height: 65vh">
                <div class="d-flex justify-content-between" style="width: 95%">
                    <div class="d-flex flex-column">
                        <form action="{{ route('admin.users-search') }}" method="GET" class="d-flex">
                            <input type="text" name="keyword" placeholder="Cari..." class="form-control me-2">
                            <button type="submit" class="btn btn-outline-secondary">Cari</button>
                        </form>
                    </div>

                    <div class="d-flex align-items-center">
                        <a href="{{ route('admin.users-create') }}">
                            <button type="button" class="btn btn-outline-secondary">Tambah Data</button>
                        </a>
                    </div>
                </div>

                <table class="table table-striped table-hover" style="width: 95%">
                    <thead>
                        <tr>
                            <th class="">Kode Pengguna</th>
                            <th class="">Nama Lengkap</th>
                            <th class="">Departemen</th>
                            <th class="">Password</th>
                            <th class="">Status</th>
                            <th class="">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $item)
                            <tr>
                                <td>{{ $item->user_code }}</td>
                                <td>{{ $item->user_fullname }}</td>
                                <td>{{ $item->departement }}</td>
                                <td>{{ Str::limit($item->user_password, 25) }}</td>
                                <td>
                                    @if ($item->data_status == 1)
                                        Aktif
                                    @else
                                        Tidak Aktif
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.users-edit', $item->user_id) }}">
                                        <button type="button" class="btn btn-outline-primary">Ubah Data</button>
                                    </a>
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModalUsers" data-id="{{ $item->user_id }}">
                                        Hapus Data
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                @if ($users->isEmpty() && request()->has('keyword'))
                                    <td colspan="10" class="py-5 text-center border border-slate-300">Data yang Anda cari
                                        tidak ditemukan.</td>
                                @endif
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <ul class="pagination justify-content-end mt-4">
                    @if ($users->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link" aria-hidden="true">&laquo;</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $users->previousPageUrl() }}&keyword={{ request('keyword') }}"
                                aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    @endif

                    @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                        <li class="page-item {{ $users->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link"
                                href="{{ $url }}&keyword={{ request('keyword') }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    @if ($users->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $users->nextPageUrl() }}&keyword={{ request('keyword') }}"
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

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="deleteModalUsers" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Penghapusan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus akun pengguna ini? Data yang dihapus tidak dapat dikembalikan.
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" action="" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-outline-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
