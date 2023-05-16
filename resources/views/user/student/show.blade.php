@php
    use Carbon\Carbon;
@endphp

@extends('template.app')

@section('content')
    @if (session('message'))
        <div class="alert alert-danger solid">
            {{ session('message') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger solid">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="profile card card-body px-3 pt-3 pb-0">
                <div class="profile-head">
                    <div class="photo-content">
                        <div class="cover-photo rounded"></div>
                    </div>
                    <div class="profile-info">
                        <div class="profile-photo">
                            <img src="https://ui-avatars.com/api/?background=random&size=100&rounded=true&length=2&name={{ $student->name }}"
                                class="img-fluid rounded-circle" alt="">
                        </div>
                        <div class="profile-details">
                            <div class="profile-name px-3 pt-2">
                                <h4 class="text-primary mb-0">{{ $student->name }}</h4>
                                <p>{{ $student->roles[0]->name }}</p>
                            </div>
                            <div class="profile-email px-2 pt-2">
                                <h4 class="text-muted mb-0">{{ $student->email }}</h4>
                                <p>Email</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('web.student.update', $student->uuid) }}" method="post" id="editStudentForm">
        @csrf
        @method('put')
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Biodata Siswa</h4>
            </div>
            <div class="card-body">
                <div class="mb-4 row">
                    <label class="col-sm-3 col-form-label fw-bold text-dark">Nama Lengkap</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control shadow" name="name" value="{{ $student->name }}">
                        @error('name')
                            <label id="name-error" class="error" for="name">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="mb-4 row">
                    <label class="col-sm-3 col-form-label fw-bold text-dark">Tempat Lahir</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control shadow" name="birth_place"
                            value="{{ $student->student->birth_place }}">
                        @error('birth_place')
                            <label id="birth_place-error" class="error" for="birth_place">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="mb-4 row">
                    <label class="col-sm-3 col-form-label fw-bold text-dark">Tanggal Lahir</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control shadow" name="date_birth"
                            value="{{ Carbon::createFromFormat('Y-m-d H:i:s', $student->student->date_birth)->isoFormat('Y-MM-D') }}">
                        @error('date_birth')
                            <label id="date_birth-error" class="error" for="date_birth">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="mb-4 row">
                    <label class="col-sm-3 col-form-label fw-bold text-dark">Kelas</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control shadow" name="class"
                            value="{{ $student->student->class }}">
                        @error('class')
                            <label id="class-error" class="error" for="class">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="mb-4 row">
                    <label class="col-sm-3 col-form-label fw-bold text-dark">Asal Sekolah</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control shadow" name="school"
                            value="{{ $student->student->school }}">
                        @error('school')
                            <label id="school-error" class="error" for="school">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="mb-4 row">
                    <label class="col-sm-3 col-form-label fw-bold text-dark">No Telepon</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control shadow" name="phone"
                            value="{{ $student->student->phone }}">
                        @error('phone')
                            <label id="phone-error" class="error" for="phone">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="mb-4 row">
                    <label class="col-sm-3 col-form-label fw-bold text-dark">Email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control shadow" name="email" value="{{ $student->email }}">
                        @error('email')
                            <label id="email-error" class="error" for="email">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('web.student.index') }}" class="btn btn-warning text-white">Kembali</a>
                <button class="btn btn-secondary">Simpan</button>
            </div>
        </div>
    </form>
@endsection

@push('js')
    <script>
        (function($, W, D) {
            var JQUERY4U = {};
            JQUERY4U.UTIL = {
                setupFormValidation: function() {
                    $("#editStudentForm").validate({
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
@endpush
