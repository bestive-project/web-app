<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BESTIVE</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('images/b-logo.png') }}">
    <link href="{{ asset('vendor/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/my.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">

    @stack('css')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        body {
            font-family: 'Poppins', sans-serif !important;
        }

        .pointer-block {
            cursor: no-drop
        }

        @media (min-width: 768px) {
            #filter {
                margin-top: -30px;
            }
        }
    </style>

</head>

<body>

    <div id="main-wrapper">

        @include('template.nav-header')

        @include('template.header')

        @include('template.sidebar')

        <div class="content-body">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>

        @include('template.footer')

    </div>

    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('js/dlabnav-init.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script>
        $(function() {
            $("body").on("click", ".btn-delete", function() {
                swal({
                    text: "Apakah anda yakin data ini dihapus ?",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Hapus",
                    cancelButtonText: "Batal",
                    closeOnConfirm: !1
                }).then((response) => {
                    if (response.value) {
                        $.ajax({
                            url: $(this).data("url"),
                            type: "post",
                            data: {
                                _token: "{{ csrf_token() }}",
                                _method: "delete"
                            },
                            success: function(response) {
                                swal({
                                    title: "Selamat",
                                    text: "Data berhasil dihapus !",
                                    type: "success"
                                }).then((result) => {
                                    window.location.reload()
                                });
                            },
                        })
                    }
                });
            })
        })
    </script>
    @if (session('successMessage'))
        {!! session('successMessage') !!}
    @endif
    @stack('js')

    @stack('modal')
</body>

</html>
