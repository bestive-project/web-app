<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>BESTIVE</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('images/b-logo.png') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

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
                        <div class="col-lg-6 py-5">
                            <div class="row h-100 align-items-center justify-content-center">
                                <form class="auth-form" action="{{ route('web.register.process') }}" method="post"
                                    id="formRegister">
                                    @if (session('message'))
                                        <div class="alert alert-danger solid alert-dismissible fade show mb-4">
                                            {!! session('message') !!}
                                        </div>
                                    @endif
                                    @csrf
                                    <div class="mb-4 row">
                                        <label class="col-sm-3 col-form-label fw-bold text-dark">Nama Lengkap</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control input-rounded shadow"
                                                name="name" value="{{ old('name') }}">
                                            @error('name')
                                                <label id="name-error" class="error"
                                                    for="name">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-4 row">
                                        <label class="col-sm-3 col-form-label fw-bold text-dark">Tempat Lahir</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control input-rounded shadow"
                                                name="birth_place" value="{{ old('birth_place') }}">
                                            @error('birth_place')
                                                <label id="birth_place-error" class="error"
                                                    for="birth_place">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-4 row">
                                        <label class="col-sm-3 col-form-label fw-bold text-dark">Tanggal Lahir</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control input-rounded shadow"
                                                name="date_birth" value="{{ old('date_birth') }}">
                                            @error('date_birth')
                                                <label id="date_birth-error" class="error"
                                                    for="date_birth">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-4 row">
                                        <label class="col-sm-3 col-form-label fw-bold text-dark">Kelas</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control input-rounded shadow"
                                                name="class" value="{{ old('class') }}">
                                            @error('class')
                                                <label id="class-error" class="error"
                                                    for="class">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-4 row">
                                        <label class="col-sm-3 col-form-label fw-bold text-dark">Asal Sekolah</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control input-rounded shadow"
                                                name="school" value="{{ old('school') }}">
                                            @error('school')
                                                <label id="school-error" class="error"
                                                    for="school">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-4 row">
                                        <label class="col-sm-3 col-form-label fw-bold text-dark">No Telepon</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control input-rounded shadow"
                                                name="phone" value="{{ old('phone') }}">
                                            @error('phone')
                                                <label id="phone-error" class="error"
                                                    for="phone">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
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
                                            style="background: #020202">Daftar</button>
                                    </div>
                                    <div class="mb-3 text-center">
                                        <a href="">Lupa Password?</a>
                                    </div>
                                    <div class="mb-3 text-center">
                                        Sudah Punya Akun? <a href="{{ route('web.login.index') }}"
                                            class="text-dark fw-bold text-decoration-underline">Login</a>
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
    <script>
        (function($, W, D) {
            var JQUERY4U = {};
            JQUERY4U.UTIL = {
                setupFormValidation: function() {
                    $("#formRegister").validate({
                        ignore: "",
                        rules: {
                            name: {
                                required: true,
                            },
                            birth_place: {
                                required: true,
                            },
                            date_birth: {
                                required: true,
                            },
                            class: {
                                required: true,
                            },
                            school: {
                                required: true,
                            },
                            phone: {
                                required: true,
                                number: true
                            },
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
                            name: {
                                required: "nama lengkap harap di isi!",
                            },
                            birth_place: {
                                required: "tempat lahir harap di isi!",
                            },
                            date_birth: {
                                required: "tanggal lahir harap di isi!",
                            },
                            class: {
                                required: "kelas harap di isi!",
                            },
                            school: {
                                required: "asal sekolah harap di isi!",
                            },
                            phone: {
                                required: "no telepon harap di isi!",
                                number: "harap masukan angka valid!"
                            },
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
