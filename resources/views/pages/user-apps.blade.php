@extends('app')

@section('content')
    <div class="card my-4 mx-5 rounded-4">
        <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('user.apps') }}">Akses Aplikasi</a>
                </li>
            </ul>
            <div class="d-flex flex-column align-items-center justify-content-center" style="height: 70vh">
                <div class="container text-center" style="min-height: 50vh">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-end mb-3" style="width: 100%">
                            <form action="{{ route('admin.map-apps-user-search') }}" method="GET" class="d-flex">
                                <input type="text" name="keyword" placeholder="Cari..." class="form-control me-2">
                                <button type="submit" class="btn btn-outline-secondary">Cari</button>
                            </form>
                        </div>
                    </div>
                    <div class="row mx-auto d-flex justify-content-center align-items-center" style="min-height: 25vh;">
                        @forelse ($maps as $index => $item)
                            <div class="col-12 col-md-3 mb-3 link">
                                <a href="{{ $item->app_url }}" class="d-flex flex-column" target="_blank">
                                    @if ($item->app_group == 'Social Media')
                                        <i class="bi bi-phone" style="font-size: 100px"></i>
                                    @elseif ($item->app_group == 'Artificial Intelligence')
                                        <i class="bi bi-search" style="font-size: 100px"></i>
                                    @elseif ($item->app_group == 'Project Management')
                                        <i class="bi bi-kanban-fill" style="font-size: 100px"></i>
                                    @else
                                        <i class="bi bi-app-indicator" style="font-size: 100px"></i>
                                    @endif
                                    {{ $item->app_name }}
                                </a>
                            </div>
                            @if (($index + 1) % 4 == 0)
                    </div>
                    <div class="row d-flex justify-content-center">
                        @endif
                    @empty
                        <div class="col-12 text-center">
                            <p>Anda masih belum diberikan hak akses oleh admin.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
                <ul class="pagination justify-content-end mt-4">
                    @if ($maps->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link" aria-hidden="true">&laquo;</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $maps->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    @endif

                    @foreach ($maps->getUrlRange(1, $maps->lastPage()) as $page => $url)
                        <li class="page-item {{ $maps->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    @if ($maps->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $maps->nextPageUrl() }}" aria-label="Next">
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
