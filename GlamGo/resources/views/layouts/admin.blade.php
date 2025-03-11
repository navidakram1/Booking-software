<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - GlamGo</title>
    <!-- Defer non-critical CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Optimize CSS transitions */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 280px;
            background: #2c3e50;
            padding: 20px;
            transition: width 0.2s ease;
            z-index: 1000;
            overflow-y: auto;
            will-change: width;
            transform: translateZ(0);
        }
        .sidebar.collapsed {
            width: 70px;
        }
        .main-content {
            margin-left: 280px;
            transition: margin-left 0.2s ease;
            min-height: 100vh;
            background: #f8f9fa;
            will-change: margin-left;
            transform: translateZ(0);
        }
        .main-content.expanded {
            margin-left: 70px;
        }
        /* Optimize animations */
        .nav-link .fa-chevron-down {
            transition: transform 0.2s ease;
            will-change: transform;
        }
        [aria-expanded="true"] .fa-chevron-down {
            transform: rotate(180deg);
        }
        /* Use hardware acceleration for mobile */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 280px;
                transition: transform 0.2s ease;
                will-change: transform;
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
            .main-content.expanded {
                margin-left: 0;
            }
        }
        .sidebar-brand {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
        }
        .sidebar-brand:hover {
            color: #ecf0f1;
            background: rgba(255, 255, 255, 0.15);
        }
        .nav-item {
            margin-bottom: 0.5rem;
        }
        .nav-link {
            color: #bdc3c7;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            font-size: 0.95rem;
        }
        .nav-link:hover {
            color: white;
            background: rgba(255,255,255,0.1);
        }
        .nav-link.active {
            color: white;
            background: #3498db;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .nav-link i {
            width: 20px;
            margin-right: 10px;
            font-size: 1.1rem;
        }
        .nav-link span {
            white-space: nowrap;
            overflow: hidden;
        }
        .collapse.nav {
            padding-left: 2.5rem;
            margin-top: 0.5rem;
        }
        .collapse.nav .nav-link {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
        }
        .top-bar {
            height: 70px;
            background: white;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            position: sticky;
            top: 0;
            z-index: 900;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .toggle-sidebar {
            background: none;
            border: none;
            color: #2c3e50;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
            margin-right: 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .toggle-sidebar:hover {
            background: #f8f9fa;
        }
        .user-dropdown {
            margin-left: auto;
        }
        .user-dropdown .btn-link {
            color: #2c3e50;
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .user-dropdown .dropdown-menu {
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        .user-dropdown .dropdown-item {
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.95rem;
        }
        .user-dropdown .dropdown-item:hover {
            background: #f8f9fa;
        }
        /* Custom Scrollbar for Sidebar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        .sidebar::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.1);
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.2);
            border-radius: 3px;
        }
        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255,255,255,0.3);
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
            <i class="fas fa-spa me-2"></i>
            <span>GlamGo Admin</span>
        </a>
        <ul class="nav flex-column">
            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                   href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Booking Management -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}" 
                   href="#bookingSubmenu" data-bs-toggle="collapse">
                    <i class="fas fa-calendar-check"></i>
                    <span>Booking Management</span>
                    <i class="fas fa-chevron-down ms-auto"></i>
                </a>
                <ul class="collapse nav flex-column ms-3" id="bookingSubmenu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.bookings.calendar') }}">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Calendar View</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.bookings.list') }}">
                            <i class="fas fa-list"></i>
                            <span>Booking List</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.bookings.pending') }}">
                            <i class="fas fa-clock"></i>
                            <span>Pending Bookings</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Service Management -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}" 
                   href="#serviceSubmenu" data-bs-toggle="collapse">
                    <i class="fas fa-spa"></i>
                    <span>Service Management</span>
                    <i class="fas fa-chevron-down ms-auto"></i>
                </a>
                <ul class="collapse nav flex-column ms-3" id="serviceSubmenu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.services.catalog') }}">
                            <i class="fas fa-book"></i>
                            <span>Service Catalog</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.services.categories') }}">
                            <i class="fas fa-tags"></i>
                            <span>Categories</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.services.offers') }}">
                            <i class="fas fa-gift"></i>
                            <span>Special Offers</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Staff Management -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.staff.*') ? 'active' : '' }}" 
                   href="#staffSubmenu" data-bs-toggle="collapse">
                    <i class="fas fa-users"></i>
                    <span>Staff Management</span>
                    <i class="fas fa-chevron-down ms-auto"></i>
                </a>
                <ul class="collapse nav flex-column ms-3" id="staffSubmenu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.staff.list') }}">
                            <i class="fas fa-user-tie"></i>
                            <span>Staff List</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.staff.schedule') }}">
                            <i class="fas fa-clock"></i>
                            <span>Schedules</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.staff.performance') }}">
                            <i class="fas fa-chart-line"></i>
                            <span>Performance</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Customer Management -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}" 
                   href="#customerSubmenu" data-bs-toggle="collapse">
                    <i class="fas fa-user-friends"></i>
                    <span>Customer Management</span>
                    <i class="fas fa-chevron-down ms-auto"></i>
                </a>
                <ul class="collapse nav flex-column ms-3" id="customerSubmenu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.customers.list') }}">
                            <i class="fas fa-users"></i>
                            <span>Customer List</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.customers.loyalty') }}">
                            <i class="fas fa-star"></i>
                            <span>Loyalty Program</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.customers.communications') }}">
                            <i class="fas fa-comments"></i>
                            <span>Communications</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Marketing Tools -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.marketing.*') ? 'active' : '' }}" 
                   href="#marketingSubmenu" data-bs-toggle="collapse">
                    <i class="fas fa-bullhorn"></i>
                    <span>Marketing</span>
                    <i class="fas fa-chevron-down ms-auto"></i>
                </a>
                <ul class="collapse nav flex-column ms-3" id="marketingSubmenu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.marketing.campaigns') }}">
                            <i class="fas fa-envelope"></i>
                            <span>Email Campaigns</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.marketing.sms') }}">
                            <i class="fas fa-sms"></i>
                            <span>SMS Marketing</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.marketing.promotions') }}">
                            <i class="fas fa-percent"></i>
                            <span>Promotions</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Content Management -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.content.*') ? 'active' : '' }}" 
                   href="#contentSubmenu" data-bs-toggle="collapse">
                    <i class="fas fa-file-alt"></i>
                    <span>Content</span>
                    <i class="fas fa-chevron-down ms-auto"></i>
                </a>
                <ul class="collapse nav flex-column ms-3" id="contentSubmenu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.content.gallery') }}">
                            <i class="fas fa-images"></i>
                            <span>Gallery</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.content.blog') }}">
                            <i class="fas fa-blog"></i>
                            <span>Blog</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.content.testimonials') }}">
                            <i class="fas fa-quote-right"></i>
                            <span>Testimonials</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Analytics -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.analytics.*') ? 'active' : '' }}" 
                   href="#analyticsSubmenu" data-bs-toggle="collapse">
                    <i class="fas fa-chart-bar"></i>
                    <span>Analytics</span>
                    <i class="fas fa-chevron-down ms-auto"></i>
                </a>
                <ul class="collapse nav flex-column ms-3" id="analyticsSubmenu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.analytics.revenue') }}">
                            <i class="fas fa-dollar-sign"></i>
                            <span>Revenue</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.analytics.bookings') }}">
                            <i class="fas fa-calendar-check"></i>
                            <span>Bookings</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.analytics.customers') }}">
                            <i class="fas fa-users"></i>
                            <span>Customers</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Settings -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" 
                   href="#settingsSubmenu" data-bs-toggle="collapse">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                    <i class="fas fa-chevron-down ms-auto"></i>
                </a>
                <ul class="collapse nav flex-column ms-3" id="settingsSubmenu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.settings.business') }}">
                            <i class="fas fa-store"></i>
                            <span>Business Settings</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.settings.integrations') }}">
                            <i class="fas fa-plug"></i>
                            <span>Integrations</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.settings.security') }}">
                            <i class="fas fa-shield-alt"></i>
                            <span>Security</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
        <!-- Top Bar -->
        <div class="top-bar">
            <button class="toggle-sidebar" id="toggle-sidebar">
                <i class="fas fa-bars"></i>
            </button>
            <div class="user-dropdown dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-user-circle"></i>
                    <span>Admin</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.profile') }}">
                            <i class="fas fa-user me-2"></i>Profile
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Page Content -->
        <div class="container-fluid py-4">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Defer non-critical JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <script>
        // Optimize JavaScript performance
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const toggleBtn = document.getElementById('toggle-sidebar');
            
            // Debounce function for performance
            function debounce(func, wait) {
                let timeout;
                return function executedFunction(...args) {
                    const later = () => {
                        clearTimeout(timeout);
                        func(...args);
                    };
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                };
            }
            
            // Optimized sidebar toggle
            const toggleSidebar = debounce(() => {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
                localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
            }, 100);
            
            // Event delegation for better performance
            document.addEventListener('click', (e) => {
                if (e.target === toggleBtn) {
                    toggleSidebar();
                }
            });
            
            // Restore sidebar state
            if (localStorage.getItem('sidebarCollapsed') === 'true') {
                sidebar.classList.add('collapsed');
                mainContent.classList.add('expanded');
            }
            
            // Optimized submenu handling
            const submenuToggles = document.querySelectorAll('[data-bs-toggle="collapse"]');
            const submenuHandler = debounce((e) => {
                const toggle = e.target.closest('[data-bs-toggle="collapse"]');
                if (toggle && !toggle.classList.contains('collapsed')) {
                    submenuToggles.forEach(otherToggle => {
                        if (otherToggle !== toggle && !otherToggle.classList.contains('collapsed')) {
                            const submenu = document.querySelector(otherToggle.getAttribute('href'));
                            if (submenu) {
                                bootstrap.Collapse.getInstance(submenu)?.hide();
                            }
                        }
                    });
                }
            }, 100);
            
            document.addEventListener('click', submenuHandler);
            
            // Keep submenu open for active items
            const activeLinks = document.querySelectorAll('.nav-link.active');
            activeLinks.forEach(link => {
                const parentCollapse = link.closest('.collapse');
                if (parentCollapse) {
                    const parentToggle = document.querySelector(`[href="#${parentCollapse.id}"]`);
                    if (parentToggle) {
                        parentCollapse.classList.add('show');
                        parentToggle.setAttribute('aria-expanded', 'true');
                    }
                }
            });
            
            // Optimized mobile handling
            const handleMobileView = debounce(() => {
                if (window.innerWidth <= 768) {
                    sidebar.classList.add('collapsed');
                    mainContent.classList.add('expanded');
                }
            }, 100);
            
            // Initial check and window resize handler
            handleMobileView();
            window.addEventListener('resize', handleMobileView);
            
            // Optimize sidebar scroll
            sidebar.addEventListener('wheel', (e) => {
                if (sidebar.scrollHeight > sidebar.clientHeight) {
                    e.stopPropagation();
                }
            }, { passive: true });
        });

        // Check session status every minute
        const SESSION_CHECK_INTERVAL = 60000; // 1 minute
        let sessionCheckTimer;

        function checkSession() {
            fetch('{{ route("admin.check-session") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.timeout || !data.authenticated) {
                    clearInterval(sessionCheckTimer);
                    alert('Your session has expired. You will be redirected to the login page.');
                    window.location.href = '{{ route("admin.login") }}';
                }
            })
            .catch(error => console.error('Session check failed:', error));
        }

        // Start session checking when document loads
        document.addEventListener('DOMContentLoaded', () => {
            sessionCheckTimer = setInterval(checkSession, SESSION_CHECK_INTERVAL);
        });

        // Reset timer on user activity
        document.addEventListener('click', () => {
            fetch('{{ route("admin.check-session") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
