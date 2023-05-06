@push('css')
    <style>
        .my-btn {
            background: linear-gradient(90deg, #C5DDE4 10.89%, #EBF6FA 33.34%, #C5DDE4 78.87%, #EBF6FA 98.8%);
            border-radius: 10px;
            box-shadow: 1px 5px 10px #EBF6FA;
            width: 100%;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: space-around;
        }
    </style>
@endpush

<div class="card">
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
</div>
