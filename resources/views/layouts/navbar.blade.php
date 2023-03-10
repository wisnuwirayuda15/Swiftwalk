<nav id="default_navbar" class="navbar navbar-expand-lg shadow fixed-top blue-green-gradient-bg">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ Request::is('admin/dashboard*') ? route('dashboard') : '/' }}">
            @if (Request::is('admin/dashboard*'))
                <i class="fa-solid fa-chart-line"></i>‎ ‎ Dashboard
            @else
                <img src="/img/swiftwalk-logo-alpha.png" alt="Swiftwalk Logo" class="logo" />
            @endif
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @if (!Request::is('admin/dashboard*'))
                <form action="{{ route('search') }}" method='POST' id="search-bar-navbar" class="nav-item"
                    role="search">
                    @csrf
                    <div class="input-group search-bar nav-padding">
                        <input type="text" class="form-control search-bar"
                            placeholder="Cari sneakers lokal incaranmu..." name="search" id="search"
                            value="{{ isset($keyword) ? $keyword : '' }}">
                        <button class="btn search-btn d-flex" type="submit"><i
                                class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            @endif
            <ul class="navbar-nav me-auto container-fluid justify-content-end">
                <li class="nav-item nav-padding px-2">
                    <a class="nav-link" aria-current="page" data-mdb-toggle="tooltip" data-mdb-placement="bottom"
                        title="Homepage" href="/">
                        <i class="fa-lg fa-{{ Request::is('/') ? 'solid' : 'regular' }} fa-house"></i>
                    </a>
                </li>
                @if (Request::is('admin/dashboard*'))
                    <li class="nav-item nav-padding px-2">
                        <a class="nav-link" aria-current="page" data-mdb-toggle="tooltip" data-mdb-placement="bottom"
                            title="Manage catalog" href="{{ route('catalog') }}">
                            <i
                                class="fa-lg fa-{{ Request::is('admin/dashboard/catalog*') ? 'solid' : 'regular' }} fa-store"></i>
                        </a>
                    </li>
                    <li class="nav-item nav-padding px-2">
                        <a class="nav-link" aria-current="page" data-mdb-toggle="tooltip" data-mdb-placement="bottom"
                            title="Manage users" href="{{ route('users') }}">
                            <i class="fa-lg fa-{{ Request::is('admin/dashboard/users*') ? 'solid' : 'regular' }} fa-user-gear"></i>
                        </a>
                    </li>
                @else
                    <li class="nav-item nav-padding px-2">
                        <a class="nav-link" aria-current="page" data-mdb-toggle="tooltip" data-mdb-placement="bottom"
                            title="Wishlist" href="{{ route('wishlist') }}">
                            <i class="fa-lg fa-{{ Request::is('wishlist*') ? 'solid' : 'regular' }} fa-heart"></i>
                            <span id="total_wishlist_badge"
                                class="badge rounded-pill badge-notification bg-danger"></span>
                        </a>
                    </li>
                    <li class="nav-item nav-padding px-2">
                        <a class="nav-link" aria-current="page" data-mdb-toggle="tooltip" data-mdb-placement="bottom"
                            title="Cart" href="{{ route('cart') }}">
                            <i class="fa-lg fa-{{ Request::is('cart*') ? 'solid' : 'regular' }} fa-cart-shopping"></i>
                            <span id="total_cart_badge" class="badge rounded-pill badge-notification bg-danger"></span>
                        </a>
                    </li>
                @endif
                <li class="nav-item nav-padding px-2">
                    @auth
                        <a href="/profile" class="nav-link btn profile-btn" data-mdb-toggle="tooltip"
                            data-mdb-placement="bottom" title="Profile">
                            @isset(auth()->user()->avatar)
                                <img src="/img/avatar/{{ auth()->user()->avatar }}" alt="avatar"
                                    class="rounded-circle img-fluid" style="width: 25px; height: 25px; object-fit: cover">
                            @else
                                <i class="fa-lg fa-solid fa-circle-user fa-lg"></i>
                            @endisset
                            {{ mb_strimwidth(auth()->user()->username, 0, 15, '...') }}
                        </a>
                    @else
                        <a href="/login" class="nav-link btn profile-btn"><i
                                class="fa-lg fa-solid fa-right-to-bracket"></i> Login</a>
                    @endauth
                </li>
            </ul>
        </div>
    </div>
</nav>
