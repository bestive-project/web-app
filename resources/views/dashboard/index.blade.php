@extends('template.app')

@section('content')
    @role('Siswa')
        @include('dashboard.student')
    @endrole
    @hasanyrole(['Admin', 'Konselor', 'Guru'])
        <div class="alert alert-primary solid">
            Selamat Datang <strong>{{ auth()->user()->name }}</strong>. Sebagai <b>{{ auth()->user()->roles[0]->name }}</b>
        </div>
    @endhasanyrole
@endsection
