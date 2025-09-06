<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Dashboard</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
          crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        html, body {
            height: 100%;
        }
        
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }
        
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.75rem 1rem;
            margin: 0.25rem 0;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }
        
        .sidebar .nav-link i {
            width: 20px;
            margin-right: 0.75rem;
        }
        
        .main-content {
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        
        .topbar {
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 1rem 0;
        }
        
        .content-area {
            padding: 2rem;
        }
        
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            border-radius: 0.75rem;
        }
        
        .card-header {
            background: white;
            border-bottom: 1px solid #e9ecef;
            border-radius: 0.75rem 0.75rem 0 0 !important;
        }
        
        .kpi-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
        }
        
        .kpi-card .card-body {
            padding: 1.5rem;
        }
        
        .kpi-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .kpi-label {
            font-size: 0.875rem;
            opacity: 0.9;
        }
        
        .status-badge {
            font-size: 0.75rem;
            padding: 0.375rem 0.75rem;
        }
        
        .table {
            background: white;
            border-radius: 0.75rem;
            overflow: hidden;
        }
        
        .table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            color: #495057;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
            transform: translateY(-1px);
        }
        
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: -250px;
                width: 250px;
                z-index: 1000;
                transition: left 0.3s ease;
            }
            
            .sidebar.show {
                left: 0;
            }
            
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid d-flex">
        <div class="row flex-grow-1">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0 d-flex">
                <div class="sidebar flex-grow-1">
                    <div class="p-3">
                        <h4 class="text-white mb-4">
                            <i class="bi bi-compass me-2"></i>
                            THUFAYLONIA
                        </h4>
                        
                        <nav class="nav flex-column">
                            <a class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}" 
                               href="{{ route('dashboard.index') }}">
                                <i class="bi bi-speedometer2"></i>
                                Overview
                            </a>
                            <a class="nav-link {{ request()->routeIs('dashboard.bookings') ? 'active' : '' }}" 
                               href="{{ route('dashboard.bookings') }}">
                                <i class="bi bi-calendar-check"></i>
                                Bookings
                            </a>
                            <a class="nav-link {{ request()->routeIs('dashboard.itineraries') ? 'active' : '' }}" 
                               href="{{ route('dashboard.itineraries') }}">
                                <i class="bi bi-map"></i>
                                Itineraries
                            </a>
                            <a class="nav-link {{ request()->routeIs('dashboard.messages') ? 'active' : '' }}" 
                               href="{{ route('dashboard.messages') }}">
                                <i class="bi bi-chat-dots"></i>
                                Messages
                                <span class="badge bg-danger ms-auto">3</span>
                            </a>
                            <a class="nav-link {{ request()->routeIs('dashboard.payments') ? 'active' : '' }}" 
                               href="{{ route('dashboard.payments') }}">
                                <i class="bi bi-credit-card"></i>
                                Payments
                            </a>
                            <a class="nav-link {{ request()->routeIs('dashboard.profile') ? 'active' : '' }}" 
                               href="{{ route('dashboard.profile') }}">
                                <i class="bi bi-person"></i>
                                Profile
                            </a>
                        </nav>
                        
                        <hr class="my-4" style="border-color: rgba(255,255,255,0.2);">
                        
                        <div class="mt-4">
                            <a href="{{ route('home') }}" class="btn btn-outline-light btn-sm w-100 mb-2">
                                <i class="bi bi-house me-2"></i>
                                Back to Home
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="d-inline w-100">
                                @csrf
                                <button type="submit" class="btn btn-outline-light btn-sm w-100">
                                    <i class="bi bi-box-arrow-right me-2"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 px-0 d-flex flex-column">
                <div class="main-content flex-grow-1">
                    <!-- Topbar -->
                    <div class="topbar">
                        <div class="container-fluid">
                            <div class="row align-items-center">
                                <div class="col">
                                    <button class="btn btn-outline-secondary d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
                                        <i class="bi bi-list"></i>
                                    </button>
                                    <h5 class="mb-0 d-none d-md-block">@yield('page-title', 'Dashboard')</h5>
                                </div>
                                <div class="col-auto">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3 text-end d-none d-md-block">
                                            <div class="fw-semibold">{{ Auth::user()->name ?? 'User' }}</div>
                                            <small class="text-muted">{{ Auth::user()->email ?? 'user@example.com' }}</small>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                <i class="bi bi-person-circle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item" href="{{ route('dashboard.profile') }}">Settings</a></li>
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
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Content Area -->
                    <div class="content-area">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Mobile sidebar toggle
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.querySelector('[data-bs-toggle="offcanvas"]');
            const sidebar = document.querySelector('.sidebar');
            
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                });
            }
            
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 768) {
                    if (!sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                        sidebar.classList.remove('show');
                    }
                }
            });
        });
    </script>
</body>
</html>
