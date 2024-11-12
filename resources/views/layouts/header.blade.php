<nav class="navbar bg-body-tertiary shadow-lg rounded-bottom-5 mx-3">
    <div class="container-fluid mx-5 my-1">
        <a class="navbar-brand d-flex" href="/">
            <img src="{{ asset('images/savoria_logo.svg') }}" alt="Logo" width="150" height="100"
                class="d-inline-block align-text-top">
            <h1 class="my-auto mx-3 fs-4">Savoria Code Test</h1>
        </a>
        @if (Route::has('login'))
            <div class="">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-lg btn-hover-custom"
                            style="border-color: gray">Logout</button>
                    </form>
                @else
                    @if (Route::currentRouteName() !== 'login')
                        <a href="{{ route('login') }}" class="mx-4">
                            <button type="button" class="btn btn-lg btn-hover-custom"
                                style="border-color: gray">Login</button>
                        </a>
                    @endif
                    {{--
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">
                            <button type="button" class="btn btn-lg btn-hover-custom"
                                style="border-color: gray">Register</button>
                        </a>
                    @endif --}}
                @endauth
            </div>
        @endif
    </div>
</nav>
