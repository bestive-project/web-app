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
            <div class="card">
                <div class="card-body">
                    <div class="profile-tab">
                        <div class="custom-tab-1">
                            <ul class="nav nav-tabs justify-content-around">
                                <li class="nav-item"><a href="#students" data-bs-toggle="tab"
                                        class="nav-link active show">Data Individu Siswa </a>
                                </li>
                                <li class="nav-item position-relative">
                                    <a href="#groups" data-bs-toggle="tab" class="nav-link">Data
                                        kelompok</a>
                                    @if ($students->count() > 0)
                                        <span class="badge light text-white bg-primary rounded-circle position-absolute"
                                            style="top: 0; right: 0;">{{ $students->count() }}</span>
                                    @endif
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="students" class="tab-pane fade active show">
                                    <div id="dataTable" class="mt-5"></div>
                                </div>
                                <div id="groups" class="tab-pane fade">
                                    <div class="alert alert-warning text-white solid mt-4" style="font-size: 18px">
                                        Berikut adalah data yang belum mendapatkan
                                        <strong>Kelompok
                                            Belajar</strong>.
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th style="width:80px;"><strong>#</strong></th>
                                                    <th><strong>Nama</strong></th>
                                                    <th><strong>Email</strong></th>
                                                    <th><strong>Kelas</strong></th>
                                                    <th><strong>Asal Sekolah</strong></th>
                                                    <th><strong>Kelompok Belajar</strong></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($students as $student)
                                                    <tr>
                                                        <th><strong>{{ $loop->iteration }}</strong></th>
                                                        <td>{{ $student->name }}</td>
                                                        <td>{{ $student->email }}</td>
                                                        <td>{{ $student->student->class }}</td>
                                                        <td>{{ $student->student->school }}</td>
                                                        <td>
                                                            <select name="study_group_id" id="assignGroup"
                                                                class="form-select"
                                                                data-url="{{ route('web.student.assign-group', $student->uuid) }}">
                                                                <option selected disabled></option>
                                                                @foreach ($studyGroups as $studyGroup)
                                                                    <option value="{{ $studyGroup->uuid }}">
                                                                        {{ $studyGroup->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        let params = {
            per_page: 10,
            page: 1,
            search: ""
        }

        $(function() {
            getUsers();

            $("body").on("keyup", "#searching", function() {
                params.search = $(this).val()
                setTimeout(() => {
                    getUsers()
                }, 1000);
            })
        })

        function getUsers() {
            $.ajax({
                url: '{{ route('web.student.table') }}',
                type: "get",
                data: params,
                success: function(response) {
                    $("#dataTable").html(response)
                }
            })
        }

        function pageChange(e) {
            params.page = e
            getUsers()
        }
    </script>
    <script>
        $(function() {
            $("body").on("change", "#assignGroup", function() {
                let url = $(this).data("url")
                $.ajax({
                    url: url,
                    type: "post",
                    data: {
                        study_group_id: $(this).val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        swal({
                            title: "Selamat",
                            text: "Data berhasil diperbaharui!",
                            type: "success"
                        }).then((result) => {
                            window.location.reload()
                        });
                    }
                })
            })
        })
    </script>
@endpush
