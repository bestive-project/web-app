@extends('template.app')

@section('content')
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
                                        class="nav-link active show">Bab Materi</a>
                                </li>
                                <li class="nav-item"><a href="#course-edit" data-bs-toggle="tab" class="nav-link">Edit
                                        Materi</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="chapters" class="tab-pane fade active show">
                                    @include('course.detail.chapter')
                                </div>
                                <div id="course-edit" class="tab-pane fade">
                                    @include('course.edit')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
