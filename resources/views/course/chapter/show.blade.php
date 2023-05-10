<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BESTIVE</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('/') }}images/b-logo.png">
    <link href="{{ asset('/') }}vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
    <link href="{{ asset('/') }}css/style.css" rel="stylesheet">
    <link href="{{ asset('/') }}css/my.css" rel="stylesheet">
    <link href="{{ asset('/') }}vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">


    <style>
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
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
                <img src="{{ asset('/') }}images/b-single-logo.svg" class="logo-abbr">
                <img src="{{ asset('/') }}images/b-text-logo.svg" class="brand-title">
            </a>
            <div class="nav-control">
                <i class="fas fa-arrow-left"></i>
            </div>
        </div>

        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="dashboard_bar">
                                {{ $chapter->course->course_name }}
                            </div>
                        </div>
                        <a href="{{ route('web.course.show.slug', $chapter->course->course_slug) }}"
                            class="btn btn-warning">Kembali</a>
                    </div>
                </nav>
            </div>
        </div>

        <div class="dlabnav">
            <div class="dlabnav-scroll">
                <ul class="metismenu" id="menu">
                    @foreach ($chapter->course->chapters as $courseChapter)
                        <li><a href="{{ route('web.chapter.show.slug', ['chapterSlug' => $courseChapter->chapter_slug, 'courseSlug' => $chapter->course->course_slug]) }}"
                                class="ai-icon" aria-expanded="false">
                                <i class="fas fa-square"></i>
                                <span class="nav-text">{{ $courseChapter->chapter_name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="content-body">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ $chapter->chapter_name }}</h3>
                    </div>
                    <div class="card-body">
                        {!! $chapter->chapter_description !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="copyright d-flex justify-content-between me-3 ms-5">
                <h5>
                    @if ($previous)
                        <a
                            href="{{ route('web.chapter.show.slug', ['chapterSlug' => $previous->chapter_slug, 'courseSlug' => $chapter->course->course_slug]) }}">
                            <i class="fas fa-arrow-left me-2"></i>
                            <b>
                                {{ $previous->chapter_name }}
                            </b>
                        </a>
                    @endif
                </h5>
                <h4 class="fw-bold">
                    {{ $chapter->chapter_name }}
                </h4>
                <h5>
                    @if ($next)
                        <a
                            href="{{ route('web.chapter.show.slug', ['chapterSlug' => $next->chapter_slug, 'courseSlug' => $chapter->course->course_slug]) }}">
                            <b>{{ $next->chapter_name }}</b>
                            <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    @endif
                </h5>
            </div>
        </div>

    </div>

    <script src="{{ asset('/') }}vendor/global/global.min.js"></script>
    <script src="{{ asset('/') }}vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>
    <script src="{{ asset('/') }}vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="{{ asset('/') }}js/custom.min.js"></script>
    <script src="{{ asset('/') }}js/dlabnav-init.js"></script>
    <script src="{{ asset('/') }}vendor/sweetalert2/dist/sweetalert2.min.js"></script>

</body>

</html>
