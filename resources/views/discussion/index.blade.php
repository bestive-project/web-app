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
                    <h4 class="card-title">Daftar Link Diskusi</h4>
                    <button type="button" class="btn btn-secondary float-end" data-bs-toggle="modal"
                        data-bs-target="#addDiscussionModal" id="addDiscussionBtn">Tambah Link Diskusi</button>
                </div>
                <div class="card-body">
                    <table class="table table-responsive-md">
                        <thead>
                            <tr>
                                <th style="width:80px;"><strong>#</strong></th>
                                <th><strong>Nama Kelompok</strong></th>
                                <th><strong>WA Link</strong></th>
                                <th><strong>Discord Link</strong></th>
                                <th><strong></strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($discussions as $discussion)
                                <tr>
                                    <td><strong>{{ $loop->iteration }}</strong></td>
                                    <td>{{ $discussion->studyGroup->name }}</td>
                                    <td><a href="{{ $discussion->wa_link }}" target="_blank" rel="noopener noreferrer"
                                            class="btn btn-success sharp btn-sm"><i class="fab fa-whatsapp fa-lg"></i></a>
                                    </td>
                                    <td><a href="{{ $discussion->discord_link }}" target="_blank" rel="noopener noreferrer"
                                            class="btn btn-secondary sharp btn-sm"><i class="fab fa-discord fa-lg"></i></a>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="#" class="btn btn-warning shadow btn-xs sharp me-1"
                                                data-bs-toggle="modal" data-bs-target="#editDiscussionModal"><i
                                                    class="fas fa-pencil-alt"
                                                    data-url="{{ route('web.discussion.show', $discussion->uuid) }}"
                                                    id="editDiscussionBtn"></i></a>
                                            <a href="#" class="btn btn-danger shadow btn-xs sharp btn-delete"
                                                data-url="{{ route('web.discussion.destroy', $discussion->uuid) }}"><i
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
@endsection

@push('modal')
    <div class="modal fade" id="addDiscussionModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Link Diskusi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <form action="{{ route('web.discussion.store') }}" method="post" id="formAddDiscussion">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Kelompok Belajar</label>
                            <select name="study_group_id" class="form-select input-rounded shadow-sm">
                                <option value="" disabled selected></option>
                                @foreach ($studyGroups as $studyGroup)
                                    <option value="{{ $studyGroup->uuid }}">{{ $studyGroup->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>WA Link</label>
                            <input type="text" name="wa_link" class="form-control input-rounded shadow-sm"
                                value="{{ old('wa_link') }}">
                        </div>
                        <div class="mb-3">
                            <label>Discord Link</label>
                            <input type="text" name="discord_link" class="form-control input-rounded shadow-sm"
                                value="{{ old('discord_link') }}">
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
    <div class="modal fade" id="editDiscussionModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Link Diskusi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <form action="{{ route('web.discussion.store') }}" method="post" id="formEditDiscussion">
                    @csrf
                    @method('put')
                    <div class="modal-body">

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
            $("body").on("click", "#editDiscussionBtn", function() {
                $("#formEditDiscussion").attr("action", $(this).data("url"))

                $.ajax({
                    url: $(this).data("url") + "/edit",
                    type: "get",
                    success: function(response) {
                        $("#formEditDiscussion .modal-body").html(response)
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
                    $("#formAddDiscussion").validate({
                        ignore: "",
                        rules: {
                            study_group_id: {
                                required: true,
                            },
                            wa_link: {
                                required: true,
                            },
                            discord_link: {
                                required: true,
                            },
                        },
                        messages: {
                            study_group_id: {
                                required: "kelompok belajar harap di isi!",
                            },
                            wa_link: {
                                required: "wa link harap di isi!",
                            },
                            discord_link: {
                                required: "discord link harap di isi!",
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
