<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Deities Design Awards')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Aboreto&family=Poppins:wght@200;300;400;500;600&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300;1,400&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('dda-assets/css/dda.css') }}">

    @stack('styles')
</head>

<body>

    {{-- Evil Eye Cursor --}}
    @include('deitiesdesignawards.partials.cursor')

    {{-- Page Loader --}}
    @include('deitiesdesignawards.partials.loader')

    {{-- Announcement Bar --}}
    @include('deitiesdesignawards.partials.announcement')

    {{-- Navigation --}}
    @include('deitiesdesignawards.partials.navbar')

    {{-- Mobile Menu Drawer --}}
    @include('deitiesdesignawards.partials.mobile-menu')

    {{-- Page Content --}}
    @yield('content')

    {{-- Footer --}}
    @include('deitiesdesignawards.partials.footer')

    {{-- Common Scripts --}}
    @include('deitiesdesignawards.partials.scripts')

    @stack('scripts')

</body>
</html>
