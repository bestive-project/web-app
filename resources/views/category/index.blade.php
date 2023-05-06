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
                    <h4 class="card-title">Daftar Mata Pelajaran</h4>
                    <button type="button" class="btn btn-secondary float-end" data-bs-toggle="modal"
                        data-bs-target="#addCategoryModal" id="addDiscussionBtn">Tambah Mata Pelajaran</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:80px;"><strong>#</strong></th>
                                    <th><strong>Mata Pelajaran</strong></th>
                                    <th><strong></strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td><strong>{{ $loop->iteration }}</strong></td>
                                        <td>{{ $category->category_name }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="#" class="btn btn-warning shadow btn-xs sharp me-1"
                                                    data-bs-toggle="modal" data-bs-target="#editCategoryModal"><i
                                                        class="fas fa-pencil-alt"
                                                        data-url="{{ route('web.category.show', $category->uuid) }}"
                                                        id="editCategoryBtn"></i></a>
                                                <a href="#" class="btn btn-danger shadow btn-xs sharp btn-delete"
                                                    data-url="{{ route('web.category.destroy', $category->uuid) }}"><i
                                                        class="fa fa-trash"></i></a>
                                            </div>
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
@endsection

@push('modal')
    <div class="modal fade" id="addCategoryModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Mata Pelajaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <form action="{{ route('web.category.store') }}" method="post" id="formAddCategory">
                    @csrf
                    <div class="modal-body">
                        <div>
                            <label>Nama Mata Pelajaran</label>
                            <input type="text" class="form-control input-rounded shadow-sm" name="category_name"
                                value="{{ old('category_name') }}">
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
    <div class="modal fade" id="editCategoryModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Mata Pelajaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <form action="{{ route('web.discussion.store') }}" method="post" id="formEditCategory">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div>
                            <label>Nama Mata Pelajaran</label>
                            <input type="text" class="form-control input-rounded shadow-sm" id="category_name"
                                name="category_name">
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
        $(document).ready(function() {
            $("body").on("click", "#editCategoryBtn", function() {
                $("#formEditCategory").attr("action", $(this).data("url"))
                $("#category_name").val(" ")

                $.ajax({
                    url: $(this).data("url") + "/edit",
                    type: "get",
                    success: function(response) {
                        $("#category_name").val(response.category_name)
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
                    $("#formAddCategory").validate({
                        ignore: "",
                        rules: {
                            category_name: {
                                required: true,
                            },
                        },
                        messages: {
                            category_name: {
                                required: "mata pelajaran harap di isi!",
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
