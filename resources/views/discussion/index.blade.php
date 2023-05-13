@extends('template.app')

@section('content')
    @role('Siswa')
        @include('discussion.student')
        @elserole('Admin')
        @include('discussion.admin')
    @endrole
@endsection
