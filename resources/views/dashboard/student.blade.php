<div class="card">
    <div class="card-header d-block">
        <h3 class="fw-bold text-capitalize">Halo, {{ $user->name }}!</h3>
        <h5 class="fw-bold" style="color: #156984">Kelas {{ $user->student->class }}</h5>
        <h5 class="fw-bold" style="color: #156984">{{ $user->student->school }}</h5>
    </div>
    <div class="card-body">
        <h2>Ada kegiatan apa hari ini ???</h2>

        <div class="d-flex flex-column flex-sm-row justify-content-around my-5">
            <div class="text-center">
                <a href="{{ route('web.schedule.live-class') }}">
                    <div class="card mb-5 shadow-lg">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <img src="{{ asset('images/onlinemeeting.png') }}" height="150" />
                        </div>
                    </div>

                    <h3 class="fw-bold mt-2">Belajar</h3>
                </a>
            </div>

            <div class="text-center">
                <a href="{{ route('web.schedule.live-counseling') }}">
                    <div class="card mb-5 shadow-lg">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <img src="{{ asset('images/counseling.png') }}" height="150" />
                        </div>
                    </div>

                    <h3 class="fw-bold mt-2">Konseling</h3>
                </a>
            </div>
        </div>
    </div>
</div>
