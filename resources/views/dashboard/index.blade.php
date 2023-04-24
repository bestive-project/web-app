@extends('template.app')

@section('content')
    @role('Siswa')
        @include('dashboard.student')
        @elserole("Admin")
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Assumenda, inventore. Quia rerum aliquid
        architecto cumque voluptatibus repellendus cupiditate harum, ullam facilis a ea optio animi voluptate?
        Velit pariatur nisi nemo.
    @endrole
@endsection
