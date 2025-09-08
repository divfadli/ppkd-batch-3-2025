<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ $title ?? '' }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    @include('inc.css')
</head>

<body>
    @include('sweetalert::alert')

    <!-- ======= Header ======= -->
    @include('inc.header')

    <!-- ======= Sidebar ======= -->
    @include('inc.sidebar')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{ $subtitle ?? 'Blank Page' }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                    @if (!empty($breadcrumbs))
                        @foreach ($breadcrumbs as $breadcrumb)
                            @if ($breadcrumb['url'])
                                <li class="breadcrumb-item">
                                    <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['label'] }}</a>
                                </li>
                            @else
                                <li class="breadcrumb-item active">{{ $breadcrumb['label'] }}</li>
                            @endif
                        @endforeach
                    @endif
                </ol>
            </nav>
        </div>

        <div class="content">
            @yield('content')
        </div>
    </main>

    <!-- ======= Footer ======= -->
    @include('inc.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    @include('inc.js')
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    @yield('script')
</body>

</html>
