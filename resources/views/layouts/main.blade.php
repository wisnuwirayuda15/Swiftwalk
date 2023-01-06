<!doctype html>
<html lang="en">

<head>
    <title>{{ $title }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.2.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- IziToast -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" />
    @yield('head-script')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/css/font-awesome/fontawesome.min.css">
    <link rel="stylesheet" href="/css/font-awesome/regular.min.css">
    <link rel="stylesheet" href="/css/font-awesome/solid.min.css">
    <link rel="stylesheet" href="/css/font-awesome/light.min.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/main.css">
    <!--Animation-->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    @yield('style')
    <h3 class="loading-animation"></h3>
</head>

<body style="background-color: rgb(255, 255, 255)">
    <header>
        @include('layouts.navbar')
        @include('layouts.input-modal')
    </header>
    <div class="navbar-margin-bottom">‎</div>
    <main>
        @yield('main')
    </main>
    <footer>
        @include('layouts.footer')
    </footer>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
    <!-- Animation -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <!-- Custom JS -->
    <script src="/js/main.js"></script>
    <script src="/js/alert.js"></script>
    <script src="/js/modal.js"></script>
    <script src="/js/animate.css.js"></script>
    <!-- Font Awesome -->
    <script src="/js/font-awesome/fontawesome.min.js"></script>
    <script src="/js/font-awesome/regular.min.js"></script>
    <script src="/js/font-awesome/solid.min.js"></script>
    <script src="/js/font-awesome/light.min.js"></script>
    @yield('script')
    @if (session()->has('alert'))
        <script>
            Swal.fire({
                icon: '{{ session('alert') }}',
                text: '{{ session('text') }}'
            });
        </script>
    @endif
</body>

</html>
