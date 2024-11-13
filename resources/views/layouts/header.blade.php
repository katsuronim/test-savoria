<nav class="navbar bg-body-tertiary shadow-lg rounded-bottom-5 mx-3">
    <div class="container-fluid mx-5 my-1">
        <a class="navbar-brand d-flex"
            href="
            @if (Auth::check()) {{ Auth::user()->departement === 'Administrator' ? route('admin.dashboard') : route('user.dashboard') }}
            @else
                {{ route('home') }} @endif">
            <img src="{{ asset('images/savoria_logo.svg') }}" alt="Logo" width="150" height="100"
                class="d-inline-block align-text-top">
            <h1 class="my-auto mx-3 fs-4">Savoria Code Test</h1>
        </a>
        @if (Route::has('login'))
            <div class="d-flex align-items-center">
                @auth
                    <!-- Dropdown for Authenticated User -->
                    <div class="dropdown">
                        <button class="btn btn-lg btn-hover-custom dropdown-toggle" type="button" id="userDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->user_fullname }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    @if (Route::currentRouteName() !== 'login')
                        <a href="{{ route('login') }}" class="mx-4">
                            <button type="button" class="btn btn-lg btn-hover-custom"
                                style="border-color: gray">Login</button>
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</nav>
