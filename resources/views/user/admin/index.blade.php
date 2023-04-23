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
                    <h4 class="card-title">Daftar Pengguna Admin</h4>
                    <button type="button" class="btn btn-secondary float-end" data-bs-toggle="modal"
                        data-bs-target="#addUserModal" id="addUserBtn">Tambah Pengguna</button>
                </div>
                <div class="card-body" id="dataTable">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('modal')
    <div class="modal fade" id="addUserModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <form action="{{ route('web.admin.store') }}" method="post" id="formAddUser">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Nama Lengkap</label>
                            <input type="text" name="name" class="form-control input-rounded shadow-sm"
                                value="{{ old('name') }}">
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control input-rounded shadow-sm"
                                value="{{ old('email') }}">
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="text" name="password" class="form-control input-rounded shadow-sm" readonly
                                value="{{ random_str(8) }}">
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
    <div class="modal fade" id="editUserModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <form action="{{ route('web.admin.index') }}" method="post" id="formEditUser">
                    @csrf
                    @method('put')
                    <div class="modal-body" id="modalEditUser">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
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
                url: '{{ route('web.admin.table') }}',
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
            $("body").on("click", "#editUserBtn", function() {
                $("#formEditUser").attr("action", $(this).data("url"))
                $.ajax({
                    url: $(this).data("url") + "/edit",
                    type: "get",
                    success: function(response) {
                        $("#modalEditUser").html(response)
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
                    $("#formAddUser").validate({
                        ignore: "",
                        rules: {
                            name: {
                                required: true,
                            },
                            email: {
                                required: true,
                                email: true
                            },
                            password: {
                                required: true,
                                minlength: 8,
                                maxlength: 255,
                            }
                        },
                        messages: {
                            name: {
                                required: "nama lengkap harap di isi!",
                            },
                            email: {
                                required: "email harap di isi!",
                                email: "harap masukan email valid!"
                            },
                            password: {
                                required: "password harap di isi!",
                                minlength: "password minimal 8!",
                                maxlength: "password maksimal 255!",
                            }
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
        (function($, W, D) {
            var JQUERY4U = {};
            JQUERY4U.UTIL = {
                setupFormValidation: function() {
                    $("#formEditUser").validate({
                        ignore: "",
                        rules: {
                            name: {
                                required: true,
                            },
                            email: {
                                required: true,
                                email: true
                            },
                        },
                        messages: {
                            name: {
                                required: "nama lengkap harap di isi!",
                            },
                            email: {
                                required: "email harap di isi!",
                                email: "harap masukan email valid!"
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
