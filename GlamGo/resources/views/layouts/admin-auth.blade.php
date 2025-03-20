<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'GlamGo') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
        }
        .auth-card {
            width: 100%;
            max-width: 400px;
            padding: 2rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .auth-logo {
            text-align: center;
            margin-bottom: 2rem;
        }
        .auth-logo img {
            max-width: 150px;
        }
        .form-control:focus {
            border-color: #ff4081;
            box-shadow: 0 0 0 0.2rem rgba(255, 64, 129, 0.25);
        }
        .btn-primary {
            background-color: #ff4081;
            border-color: #ff4081;
        }
        .btn-primary:hover {
            background-color: #f50057;
            border-color: #f50057;
        }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add CSRF token to all AJAX requests
        document.addEventListener('DOMContentLoaded', function() {
            let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            // Add CSRF token to all AJAX requests
            let oldXHR = window.XMLHttpRequest;
            function newXHR() {
                let xhr = new oldXHR();
                xhr.addEventListener('readystatechange', function() {
                    if(xhr.readyState === 4 && xhr.status === 419) {
                        window.location.reload();
                    }
                });
                return xhr;
            }
            window.XMLHttpRequest = newXHR;
            
            // Add CSRF token to all fetch requests
            let originalFetch = window.fetch;
            window.fetch = function() {
                let resource = arguments[0];
                let config = arguments[1] || {};
                
                if(config.method && ['POST', 'PUT', 'DELETE', 'PATCH'].includes(config.method.toUpperCase())) {
                    if(!config.headers) {
                        config.headers = {};
                    }
                    config.headers['X-CSRF-TOKEN'] = token;
                }
                
                return originalFetch.apply(this, arguments).then(response => {
                    if(response.status === 419) {
                        window.location.reload();
                    }
                    return response;
                });
            };
        });
    </script>
    @stack('scripts')
</body>
</html> 