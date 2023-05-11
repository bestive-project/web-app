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
            <h2 class="fw-bold">Ayo cek jadwal live class-mu!</h2>
        </div>
        <div class="card-body">
            <div>
                <div class="my-btn">
                    <span class="text-dark fw-bold">Live Class</span>
                </div>
                <div class="card mt-4 shadow">
                    <div class="card-body d-flex justify-content-center align-items-center">
                        @if ($user->student->studyGroup && $user->student->studyGroup->liveClass)
                            @if (Carbon::now()->isoFormat('dddd') == $user->student->studyGroup->liveClass->day)
                                <a href="{{ $user->student->studyGroup->liveClass->link_meet }}" target="_blank"
                                    class="btn btn-info">Mulai Live Class</a>
                            @else
                                <p>Tidak ada jadwal live class</p>
                            @endif
                        @else
                            <p>Maaf anda belum terdaftar <br> kedalam kelompok belajar</p>
                        @endif
                    </div>
                </div>
            </div>
            <hr class="my-5">
            <div>
                <div class="my-btn">
                    <span class="text-dark fw-bold">Riwayat Kelas</span>
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
                            @foreach ($user->student->studyGroup->liveClass->logRecordings()->orderBy('id', 'DESC')->get() as $logRecording)
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
        </div>
    </div>
@endsection
