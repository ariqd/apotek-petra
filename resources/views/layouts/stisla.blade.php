<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ @$title }} | Apotek Petra</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    {{ @$css }}

    <style>
        .loading {
            background: lightgrey;
            padding: 15px;
            position: fixed;
            border-radius: 4px;
            left: 50%;
            top: 50%;
            text-align: center;
            margin: -40px 0 0 -50px;
            z-index: 2000;
            display: none;
        }

    </style>

    @livewireStyles
</head>

<body class="layout-2">
<div id="app">
    <div class="loading" id="loading" style="font-size: 20px">
        <i class="fas fa-sync fa-spin fa-2x fa-fw"></i><br/>
        <span>Loading</span>
    </div>
    <div class="main-wrapper">
    @include('components.navbar')

    @include('components.sidebar')

    <!-- Main Content -->
        <div class="main-content">
            @include('components.feedback')
            <section class="section">
                {{ $slot }}
            </section>
            {{ @$modal }}
        </div>

        <footer class="main-footer">
            <div class="footer-left">
                Copyright &copy; 2021
                <div class="bullet"></div>
                Apotek Petra
            </div>
            <div class="footer-right">

            </div>
        </footer>
    </div>
</div>

<!-- General JS Scripts -->
<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('assets/modules/popper.js') }}"></script>
<script src="{{ asset('assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
{{-- <script src="{{ asset('assets/modules/moment.min.js') }}"></script> --}}
<script src="{{ asset('assets/js/stisla.js') }}"></script>

<!-- JS Libraies -->
{{-- <script src="{{ asset('assets/modules/sticky-kit.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/modules/prism/prism.js') }}"></script> --}}
<script src="{{ asset('assets/modules/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/js/page/bootstrap-modal.js') }}"></script>
@livewireScripts
{{ @$js }}
</body>

</html>
