@extends('template.app')

@section('content')
    @hasanyrole(['Admin', 'Guru', 'Konselor'])
        @include('discussion.admin')
    @endhasanyrole

    @role('Siswa')
        @include('discussion.student')
    @endrole
@endsection
