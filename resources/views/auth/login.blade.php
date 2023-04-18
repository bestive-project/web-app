<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BESTIVE</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('images/b-logo.png') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">

</head>

<body class="vh-100">
    <div class="authincation h-100 bg-white">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="authincation-content shadow-lg">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="auth-form d-flex h-100 justify-content-center align-items-center">
                                <img src="{{ asset('images/b-logo.png') }}" width="300" height="300">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row h-100 align-items-center justify-content-center">
                                <form class="auth-form" action="{{ route('web.login.process') }}" method="post"
                                    id="formLogin">
                                    @if (session('message'))
                                        <div class="alert alert-danger solid alert-dismissible fade show mb-4">
                                            {!! session('message') !!}
                                        </div>
                                    @endif
                                    @csrf
                                    <div class="mb-4 row">
                                        <label class="col-sm-3 col-form-label fw-bold text-dark">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control input-rounded shadow"
                                                name="email" value="{{ old('email') }}">
                                            @error('email')
                                                <label id="email-error" class="error"
                                                    for="email">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-4 row">
                                        <label class="col-sm-3 col-form-label fw-bold text-dark">Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control input-rounded shadow"
                                                name="password">
                                            @error('password')
                                                <label id="password-error" class="error"
                                                    for="password">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 text-center">
                                        <button class="btn btn-dark btn-sm h-25 w-25 shadow"
                                            style="background: #020202">Login</button>
                                    </div>
                                    <div class="mb-3 text-center">
                                        <a href="">Lupa Password?</a>
                                    </div>
                                    <div class="mb-3 text-center">
                                        Belum Punya Akun? <a href="{{ route('web.register.index') }}"
                                            class="text-dark fw-bold text-decoration-underline">Daftar</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    @if (session('successMessage'))
        {!! session('successMessage') !!}
    @endif
    <script>
        (function($, W, D) {
            var JQUERY4U = {};
            JQUERY4U.UTIL = {
                setupFormValidation: function() {
                    $("#formLogin").validate({
                        ignore: "",
                        rules: {
                            email: {
                                required: true,
                                email: true
                            },
                            password: {
                                required: true,
                                minlength: 8,
                                maxlength: 255,
                            }
                        },
                        messages: {
                            email: {
                                required: "email harap di isi!",
                                email: "harap masukan email valid!"
                            },
                            password: {
                                required: "password harap di isi!",
                                minlength: "password minimal 8!",
                                maxlength: "password maksimal 255!",
                            }
                        },
                        submitHandler: function(form) {
                            form.submit();
                        }
                    });
                }
            }
            $(D).ready(function($) {
                JQUERY4U.UTIL.setupFormValidation();
            });
        })(jQuery, window, document);
    </script>
</body>

</html>
