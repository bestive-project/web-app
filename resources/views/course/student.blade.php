@push('css')
    <style>
        .card-img-top {
            background-size: cover;
            background-position: center;
            min-height: 10rem;
            width: 100%;
        }
    </style>
@endpush

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Kumpulan Materi Pembelajaran</h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    @foreach ($courses as $course)
        <div class="col-lg-4 col-sm-6">
            <div class="card">
                <img src="{{ asset('images/profile/cover.jpg') }}" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">{{ $course->course_name }}</h5>
                    <p class="card-text">
                    <ul>
                        <li>Jumlah BAB : {{ $course->chapters->count() }}</li>
                    </ul>
                    </p>
                    <a href="{{ route('web.course.show.slug', $course->course_slug) }}"
                        class="btn btn-primary">Selengkapnya</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

{{-- <div class="card">
    <div class="card-header d-block">
        <h2 class="fw-bold">Ayo cek jadwal live class-mu!</h2>
    </div>
    <div class="card-body">
        <div class="my-btn">
            <a href="" class="text-dark fw-bold">Live Class</a>
            <a href="" class="text-dark fw-bold">Riwayat Kelas</a>
        </div>
        <div class="d-flex flex-column flex-sm-row justify-content-around">
            <div class="card mb-5 shadow">
                <div class="card-body d-flex justify-content-center align-items-center">
                    <img src="https://bestive.integrasiautama.my.id/assets/images/bimbel-interactive.png"
                        alt="Bimbel Interaktif" />
                </div>
            </div>
            <div class="card mb-5 shadow">
                <div class="card-body d-flex justify-content-center align-items-center">
                    <img src="https://bestive.integrasiautama.my.id/assets/images/konseling-belajar.png"
                        alt="Bimbel Interaktif" />
                </div>
            </div>
        </div>
    </div>
</div> --}}
