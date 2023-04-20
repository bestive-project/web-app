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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Daftar Pengguna Siswa</h4>
                </div>
                <div class="card-body" id="dataTable">
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
                getUsers()
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
