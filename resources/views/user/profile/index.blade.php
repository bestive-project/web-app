@extends('template.app')

@section('content')
    @if (session('message'))
        <div class="alert alert-danger solid">
            {{ session('message') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger solid">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            @role('Admin')
                @include('user.profile.admin')
                @elserole('Guru')
                @include('user.profile.teacher')
                @elserole("Konselor")
                @include('user.profile.counselor')
                @elserole("Siswa")
                @include('user.profile.student')
            @endrole
        </div>
    </div>
@endsection
