@extends('template.app')

@section('content')
    @hasanyrole(['Siswa', 'Guru', 'Konselor'])
        @include('discussion.student')
    @endhasanyrole

    @role('Admin')
        @include('discussion.admin')
    @endrole
@endsection
