@extends('template.app')

@section('content')
    @role('Siswa')
        @include('course.student')
        @elserole('Admin')
        @include('course.admin')
    @endrole
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

            $("body").on("click", "#changeStatus", function() {
                $.ajax({
                    url: $(this).data('url'),
                    type: "get",
                    data: {
                        _method: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        swal({
                            title: "Selamat",
                            text: "Data berhasil diperbaharui",
                            type: "success"
                        }).then((result) => {
                            getUsers()
                        });
                    }
                })
            })
        })

        function getUsers() {
            $.ajax({
                url: '{{ route('web.course.table') }}',
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
