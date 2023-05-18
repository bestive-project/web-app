@php
    use Carbon\Carbon;
@endphp

@extends('template.app')

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

@section('content')
    <div class="card">
        <div class="card-header d-block">
            <h2 class="fw-bold">Ayo cek jadwal konseling anda!</h2>
        </div>
        <div class="card-body">
            <div>
                <div class="my-btn">
                    <span class="text-dark fw-bold">Konseling</span>
                </div>
                @if ($user->student->studyGroup && $user->student->studyGroup->liveCounseling)
                    <div class="card mt-4 shadow">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            @if (Carbon::now()->isoFormat('dddd') == $user->student->studyGroup->liveCounseling->day)
                                <a href="{{ $user->student->studyGroup->liveCounseling->link_meet }}" target="_blank"
                                    class="btn btn-info">Mulai Konseling</a>
                            @else
                                <p>Tidak ada jadwal Konseling</p>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="alert mt-4 alert-danger solid">
                        Maaf anda belum terdaftar kedalam kelompok belajar. Segera hubungi admin Bestive!
                    </div>
                @endif
            </div>
            <hr class="my-5">
            @if ($user->student->studyGroup && $user->student->studyGroup->liveCounseling)
                <div>
                    <div class="my-btn">
                        <span class="text-dark fw-bold">Riwayat Konseling</span>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:80px;"><strong>#</strong></th>
                                    <th><strong>Riwayat</strong></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user->student->studyGroup->liveCounseling->logRecordings()->orderBy('id', 'DESC')->get() as $logRecording)
                                    <tr>
                                        <td><strong>{{ $loop->iteration }}</strong></td>
                                        <td>{{ $logRecording->link_title }}</td>
                                        <td>
                                            <a href="{{ $logRecording->link_recording }}" target="_blank"
                                                class="btn btn-info">Nonton</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
