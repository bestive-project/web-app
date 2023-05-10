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
                                <li class="nav-item"><a href="#groups" data-bs-toggle="tab" class="nav-link">Data
                                        kelompok</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="students" class="tab-pane fade active show">
                                    <div id="dataTable" class="mt-4"></div>
                                </div>
                                <div id="groups" class="tab-pane fade">
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
@endpush
