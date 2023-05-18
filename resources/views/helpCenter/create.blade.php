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

    <div class="row ">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pusat Bantuan</h4>
                </div>
                <form action="{{ route('web.help-center.store') }}" method="post" id="formAddHelpCenter">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label>Permasalahan</label>
                            <select name="type" class="form-select" onchange="changeType(this)">
                                <option value="COUNSELING">Konseling</option>
                                <option value="TEACHER">Pembelajaran</option>
                                <option value="OTHER" selected>Lainnya</option>
                            </select>
                        </div>
                        <div class="mb-3" style="display: none" id="teacherSelect">
                            <label>Guru</label>
                            <select name="assign_to" class="form-select" required>
                                <option selected disabled></option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->uuid }}">{{ $teacher->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3" style="display: none" id="counselorSelect">
                            <label>Konselor</label>
                            <select name="assign_to" class="form-select" required>
                                <option selected disabled></option>
                                @foreach ($counselors as $counselor)
                                    <option value="{{ $counselor->uuid }}">{{ $counselor->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Deskripsi Masalah</label>
                            <textarea name="message" class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="form-control text-white btn btn-secondary bg-secondary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function changeType(params) {
            if (params.value == "COUNSELING") {
                $("#counselorSelect").css("display", "block")
                $("#teacherSelect").css("display", "none")
            }

            if (params.value == "TEACHER") {
                $("#teacherSelect").css("display", "block")
                $("#counselorSelect").css("display", "none")
            }

            if (params.value == "OTHER") {
                $("#teacherSelect").css("display", "none")
                $("#counselorSelect").css("display", "none")
            }
        }
    </script>
    <script>
        (function($, W, D) {
            var JQUERY4U = {};
            JQUERY4U.UTIL = {
                setupFormValidation: function() {
                    $("#formAddHelpCenter").validate({
                        ignore: "",
                        rules: {
                            message: {
                                required: true,
                            },
                        },
                        messages: {
                            message: {
                                required: "deskripsi masalah harap di isi!",
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
