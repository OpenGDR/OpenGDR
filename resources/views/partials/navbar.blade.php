<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        @guest
        <a class="navbar-brand" href="{{ route('home.public') }}">
            {{ config('app.name', 'Open GDR') }}
        </a>
        @else
        <a class="navbar-brand" href="{{ route('home') }}">
            {{ config('app.name', 'Open GDR') }}
        </a>
        @endguest

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Accedi') }}</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                    </li>
                    @endif
                @else
                    @can('showAdminMenu', \App\Models\User::class)
                        <li class="nav-item dropdown">
                            <a id="navbarDropdownAdmin" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Impostazioni <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownAdmin">
                                @can('viewAny', \App\Models\User::class)
                                    <a href="{{ route('admin.user.list') }}" class="dropdown-item">Utenti</a>
                                @endcan
                                @can('viewAny', \App\Models\Race::class)
                                    <a href="{{ route('admin.race.list') }}" class="dropdown-item">Razze</a>
                                @endcan
                            </div>
                        </li>
                    @endcan
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @lang('Utente') <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a href="{{ route('user.settings') }}" class="dropdown-item">Impostazioni</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Esci') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
        @endguest
    </ul>
</div>
</div>
</nav>
