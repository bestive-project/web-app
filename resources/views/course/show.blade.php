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
                        <div class="position-absolute">
                            <h2 class="p-5 text-white">Materi : {{ $course->course_name }}</h2>
                        </div>
                        <div class="cover-photo rounded"></div>
                    </div>
                    <div class="profile-info">
                        <div class="profile-photo">
                            <img src="https://ui-avatars.com/api/?background=random&size=100&rounded=true&length=2&name={{ $course->user->name }}"
                                class="img-fluid rounded-circle" alt="">
                        </div>
                        <div class="profile-details">
                            <div class="profile-name px-3 pt-2">
                                <h4 class="text-primary mb-0">{{ $course->user->name }}</h4>
                                <p>{{ $course->user->roles[0]->name }}</p>
                            </div>
                            <div class="profile-email px-2 pt-2">
                                <h4 class="text-muted mb-0">{{ $course->user->email }}</h4>
                                <p>Email</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="profile-tab">
                        <div class="custom-tab-1">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a href="#chapters" data-bs-toggle="tab"
                                        class="nav-link active show">BAB Materi</a>
                                </li>
                                @hasanyrole(['Admin', 'Guru'])
                                    <li class="nav-item"><a href="#course-edit" data-bs-toggle="tab" class="nav-link">Edit
                                            Materi</a>
                                    </li>
                                @endhasanyrole
                            </ul>
                            <div class="tab-content">
                                <div id="chapters" class="tab-pane fade active show">
                                    @include('course.detail.chapter')
                                </div>
                                @hasanyrole(['Admin', 'Guru'])
                                    <div id="course-edit" class="tab-pane fade">
                                        @include('course.edit')
                                    </div>
                                @endhasanyrole
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('modal')
    <div class="modal fade" id="addQuizModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Simpan Kuis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <form action="{{ route('web.quiz.store') }}" method="post" id="formAddQuiz">
                    <input type="hidden" name="chapter_id">
                    <input type="hidden" name="course_id">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Link Kuis</label>
                            <input type="url" name="link_quiz" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush

@push('js')
    <script>
        function redirect(params) {
            window.location.href = params;
        }

        $("body").on("click", ".btn-quiz", function() {
            $("input[name='link_quiz']").val(" ")
            $("input[name='chapter_id']").val($(this).data("chapterid"))
            $("input[name='course_id']").val($(this).data("courseid"))

            if ($(this).data("quiz")) {
                $("input[name='link_quiz']").val($(this).data("quiz"))
            }
        })
    </script>
    <script>
        (function($, W, D) {
            var JQUERY4U = {};
            JQUERY4U.UTIL = {
                setupFormValidation: function() {
                    $("#formAddQuiz").validate({
                        ignore: "",
                        rules: {
                            link_quiz: {
                                required: true,
                            },
                        },
                        messages: {
                            link_quiz: {
                                required: "link kuis harap di isi!",
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
