<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm navbar-modern" role="navigation" aria-label="Main navigation">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand text-primary fw-bold brand-modern" href="{{ route('home') }}" aria-label="THUFAYLONIA Home">
            THUFAYLONIA
        </a>

        <!-- Mobile menu button -->
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Desktop Navigation Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto nav-underline-modern">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active text-primary' : '' }}" 
                       href="{{ route('home') }}"
                       aria-current="{{ request()->routeIs('home') ? 'page' : 'false' }}">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('tours') ? 'active text-primary' : '' }}" 
                       href="{{ route('tours') }}"
                       aria-current="{{ request()->routeIs('tours') ? 'page' : 'false' }}">
                        Tours
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('guides') ? 'active text-primary' : '' }}" 
                       href="{{ route('guides') }}"
                       aria-current="{{ request()->routeIs('guides') ? 'page' : 'false' }}">
                        Guides
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        About
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Contact
                    </a>
                </li>
            </ul>

            <!-- Auth Area -->
            @guest
                <div class="d-flex gap-2">
                    <a href="{{ route('login') }}" 
                       class="btn btn-outline-primary btn-sm"
                       aria-label="Login to your account">
                        Login
                    </a>
                    <a href="{{ route('register') }}" 
                       class="btn btn-primary btn-sm"
                       aria-label="Create a new account">
                        Register
                    </a>
                </div>
            @endguest

            @auth
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-primary btn-sm">Dashboard</a>
                    <div class="dropdown">
                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name ?? 'Account' }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</nav>
