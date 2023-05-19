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
                    <h4 class="card-title">Daftar Jadwal Konseling</h4>
                    @role('Admin')
                        <button type="button" class="btn btn-secondary float-end" data-bs-toggle="modal"
                            data-bs-target="#addliveCounselingModal">Tambah Jadwal</button>
                    @endrole
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    @role('Admin')
                                        <th><strong>Penanggung Jawab</strong></th>
                                    @endrole
                                    <th><strong>Kelompok Belajar</strong></th>
                                    <th><strong>Hari</strong></th>
                                    <th><strong>Jam</strong></th>
                                    <th><strong></strong></th>
                                    @role('Admin')
                                        <th><strong></strong></th>
                                    @endrole
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($liveCounselings as $liveCounseling)
                                    <tr>
                                        @role('Admin')
                                            <td>{{ $liveCounseling->user->name }}</td>
                                        @endrole
                                        <td>{{ $liveCounseling->studyGroup->name }}</td>
                                        <td>{{ $liveCounseling->day }}</td>
                                        <td>{{ $liveCounseling->hour }}</td>
                                        <td><a href="{{ $liveCounseling->link_meet }}" target="_blank"
                                                rel="noopener noreferrer" class="btn btn-info">Join Meet</a>
                                            <a href="{{ route('web.live-counseling.show', $liveCounseling->uuid) }}"
                                                class="btn btn-primary">Upload Recording</a>
                                        </td>
                                        @role('Admin')
                                            <td>
                                                <div class="d-flex">
                                                    <a href="#" class="btn btn-warning shadow btn-xs sharp me-1"
                                                        data-bs-toggle="modal" data-bs-target="#editliveCounselingModal"><i
                                                            class="fas fa-pencil-alt"
                                                            data-url="{{ route('web.live-counseling.show', $liveCounseling->uuid) }}"
                                                            id="editLiveCounselingModal"></i></a>
                                                    <a href="#" class="btn btn-danger shadow btn-xs sharp btn-delete"
                                                        data-url="{{ route('web.live-counseling.destroy', $liveCounseling->uuid) }}"><i
                                                            class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        @endrole
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
    <div class="modal fade" id="addliveCounselingModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Jadwal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <form action="{{ route('web.live-counseling.store') }}" method="post" id="formAddliveCounseling">
                    @csrf
                    <div class="modal-body">
                        @role('Admin')
                            <div class="mb-3">
                                <label>Penanggung Jawab</label>
                                <select name="user_id" class="form-select input-rounded shadow-sm">
                                    <option selected disabled></option>
                                    @foreach ($counselors as $counselor)
                                        <option value="{{ $counselor->uuid }}">{{ $counselor->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @elserole("Konselor")
                            <input type="hidden" name="user_id" value="{{ auth()->user()->uuid }}">
                        @endrole
                        <div class="mb-3">
                            <label>Kelompok Belajar</label>
                            <select name="study_group_id" class="form-select input-rounded shadow-sm">
                                <option selected disabled></option>
                                @foreach ($studyGroups as $studyGroup)
                                    <option value="{{ $studyGroup->uuid }}">{{ $studyGroup->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <label>Jadwal Konseling</label>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <select name="day" class="form-select input-rounded shadow-sm">
                                        <option selected disabled></option>
                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jumat">Jumat</option>
                                        <option value="Sabtu">Sabtu</option>
                                        <option value="Minggu">Minggu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <input type="time" class="form-control input-rounded shadow-sm" name="hour"
                                        value="">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Link Meet</label>
                            <input type="text" class="form-control input-rounded shadow-sm" name="link_meet"
                                value="{{ old('link_meet') }}">
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
    <div class="modal fade" id="editliveCounselingModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Jadwal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <form action="{{ route('web.discussion.store') }}" method="post" id="formEditliveCounseling">
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
            $("body").on("click", "#editLiveCounselingModal", function() {
                console.log("OK");
                $("#formEditliveCounseling").attr("action", $(this).data("url"))

                $.ajax({
                    url: $(this).data("url") + "/edit",
                    type: "get",
                    success: function(response) {
                        $("#formEditliveCounseling .modal-body").html(response)
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
                    $("#formAddliveCounseling").validate({
                        ignore: "",
                        rules: {
                            study_group_id: {
                                required: true,
                            },
                            day: {
                                required: true,
                            },
                            hour: {
                                required: true,
                            },
                            link_meet: {
                                required: true,
                            },
                        },
                        messages: {
                            study_group_id: {
                                required: "kelompok belajar harap di isi!",
                            },
                            day: {
                                required: "hari harap di isi!",
                            },
                            hour: {
                                required: "jam harap di isi!",
                            },
                            link_meet: {
                                required: "link harap di isi!",
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
