@extends('template.app')

@push('css')
    <style>
        .custom-ekeditor .error {}
    </style>
@endpush

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
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tambah Materi</h4>
                </div>
                <form action="{{ route('web.course.store') }}" method="post" id="formAddCourse">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label>Mata Pelajaran</label>
                            <select name="category_id" class="form-select">
                                <option selected disabled></option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->uuid }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Judul Materi</label>
                            <input type="text" class="form-control" name="course_name" value="{{ old('course_name') }}">
                        </div>
                        <div class="mb-3 custom-ekeditor">
                            <label>Deskripsi Materi</label>
                            <textarea id="ckeditor" name="course_description">{{ old('course_description') }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('web.course.index') }}" class="btn btn-warning text-white">Kembali</a>
                        <button class="btn btn-secondary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script>
        (function($, W, D) {
            var JQUERY4U = {};
            JQUERY4U.UTIL = {
                setupFormValidation: function() {
                    $("#formAddCourse").validate({
                        ignore: "",
                        rules: {
                            category_id: {
                                required: true,
                            },
                            course_name: {
                                required: true,
                            },
                            course_description: {
                                required: true,
                            },
                        },
                        messages: {
                            category_id: {
                                required: "mata pelajaran harap di isi!",
                            },
                            course_name: {
                                required: "judul materi harap di isi!",
                            },
                            course_description: {
                                required: "deskripsi materi harap di isi!",
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
