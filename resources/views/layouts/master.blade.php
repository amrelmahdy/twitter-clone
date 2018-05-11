<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.header')
</head>
<body>
<div class="main-content">
    <div id="app">
        @include('includes.navbar')
        @yield('content')
    </div>
</div>

@include('includes.footer')
</body>
</html>
