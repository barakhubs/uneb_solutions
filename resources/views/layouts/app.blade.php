<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="robots" content="max-snippet:150" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'UNEB Solutions') }} :: @yield('title') - A UNEB resources store for all you need t excel in UNEB</title>
    <meta content="UNEB, UNEB Past papers, UNEB solutions, Uganda, Uganda examinations, MOCKS, mocks, PLE, UCE, UACE, UNEB results" name="keywords">
    <meta content="UNEB Solutions is a store for all UNEB resources you need to excel in your exams from PLE, UCE, and UACE. We also have mocks resources, assignments, exercises, tests, termly examinations and many more" name="description">

    <!-- Favicon -->
    <link href="{{ asset('favicon.ico') }}" rel="icon">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('new/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('new/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('new/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('new/css/flaticon.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('new/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('new/css/barfiller.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('new/css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('new/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('new/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('new/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('new/css/style.css') }}" type="text/css">
</head>

<body>
        <!-- Navbar Start -->
        @include('layouts.header')
        <!-- Navbar End -->

        @yield('content')


        <!-- Footer Start -->
        @include('layouts.footer')
        <!-- Footer End -->


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Js Plugins -->
    <script src="{{ asset('new/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('new/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('new/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('new/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('new/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('new/js/jquery.barfiller.js') }}"></script>
    <script src="{{ asset('new/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('new/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('new/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('new/js/main.js') }}"></script>


    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.8/pdfobject.min.js" integrity="sha512-MoP2OErV7Mtk4VL893VYBFq8yJHWQtqJxTyIAsCVKzILrvHyKQpAwJf9noILczN6psvXUxTr19T5h+ndywCoVw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Template Javascript -->
    <script>
        $(document).ready(function() {
            $('.summernote').summernote();
        });
    </script>
    <script>
        PDFObject.embed("http://127.0.0.1:8000/storage/files/16653877341664295332brit-invoice.pdf", "#pdf-viewer");
    </script>
</body>

</html>
