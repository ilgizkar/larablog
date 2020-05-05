<nav class="navbar page-header">
    <a href="#" class="btn btn-link sidebar-mobile-toggle d-md-none mr-auto">
        <i class="fa fa-bars"></i>
    </a>

    <a class="navbar-brand" title="Обратно в блог" href="{{ route('index') }}">
        <img src="{{ asset('admin/assets/dist/imgs/logo.png')}}" alt="logo">
    </a>

    <a href="#" title="Свернуть/Развернуть боковую панель" class="btn btn-link sidebar-toggle d-md-down-none">
        <i class="fa fa-bars"></i>
    </a>

    <ul class="navbar-nav ml-auto">
        @if(Auth::user()->author == true)
            <a href="{{ route('newPost') }}" class="btn btn-primary mr-3">Написать пост</a>
        @endif
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{ asset('admin/assets/dist/imgs/avatar-1.png')}}" class="avatar avatar-sm" alt="logo">
                <span class="small ml-1 d-md-down-none">{{ Auth::user()->name }}</span>
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('userProfilePost') }}" class="dropdown-item">
                    <i class="fa fa-user"></i> Профиль
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    <i class="fa fa-lock"></i> Выйти
                </a>

            </div>
        </li>
    </ul>
</nav>
