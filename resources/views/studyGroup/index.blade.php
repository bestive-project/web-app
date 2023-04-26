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
                    <h4 class="card-title">Daftar Kelompok Belajar</h4>
                    <button type="button" class="btn btn-secondary float-end" data-bs-toggle="modal"
                        data-bs-target="#addStudyGroupModal" id="addStudyGroupBtn">Tambah Kelompok</button>
                </div>
                <div class="card-body" id="dataTable">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('modal')
    <div class="modal fade" id="addStudyGroupModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kelompok</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <form action="{{ route('web.study-group.store') }}" method="post" id="formAddStudyGroup">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Nama Kelompok</label>
                            <input type="text" name="name" class="form-control input-rounded shadow-sm"
                                value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editStudyGroupModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Kelompok</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <form action="{{ route('web.study-group.store') }}" method="post" id="formEditStudyGroup">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Nama Kelompok</label>
                            <input type="text" name="name" class="form-control input-rounded shadow-sm"
                                value="{{ old('name') }}" id="editName">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush

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
                url: '{{ route('web.study.group.table') }}',
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

        $(document).ready(function() {
            $("body").on("click", "#editStudyGroupBtn", function() {
                $("#formEditStudyGroup").attr("action", $(this).data("url"))

                $.ajax({
                    url: $(this).data("url") + "/edit",
                    type: "get",
                    success: function(response) {
                        $("#editName").val(response.name)
                    },
                })
            })
        })
    </script>
    <script>
        (function($, W, D) {
            var JQUERY4U = {};
            JQUERY4U.UTIL = {
                setupFormValidation: function() {
                    $("#formAddStudyGroup").validate({
                        ignore: "",
                        rules: {
                            name: {
                                required: true,
                            },
                        },
                        messages: {
                            name: {
                                required: "nama kelompok harap di isi!",
                            },
                        },
                        submitHandler: function(form) {
                            form.submit();
                        }
                    });
                    $("#formEditStudyGroup").validate({
                        ignore: "",
                        rules: {
                            name: {
                                required: true,
                            },
                        },
                        messages: {
                            name: {
                                required: "nama kelompok harap di isi!",
                            },
                        },
                        submitHandler: function(form) {
                            form.submit();
                        }
                    });
                }
            }
            $(D).ready(function($) {
                JQUERY4U.UTIL.setupFormValidation();
            });
        })(jQuery, window, document);
    </script>
@endpush
