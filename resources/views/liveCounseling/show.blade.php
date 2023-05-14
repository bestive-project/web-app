@php
    use Carbon\Carbon;
@endphp

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
                    <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addLogRecordingModal">Tambah
                        Record</button>

                    <a href="{{ route('web.live-class.index') }}" class="btn btn-warning float-end">Kembali</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:80px;"><strong>#</strong></th>
                                    <th><strong>Report Recording</strong></th>
                                    <th><strong></strong></th>
                                    <th><strong></strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($liveCounseling->logRecordings as $logRecording)
                                    <tr>
                                        <td><strong>{{ $loop->iteration }}</strong></td>
                                        <td>{{ $logRecording->link_title }}</td>
                                        <td><a href="{{ $logRecording->link_recording }}" target="_blank"
                                                class="btn btn-info">Nonton</a></td>
                                        <td>
                                            <a href="#" class="btn btn-danger shadow btn-xs sharp btn-delete"
                                                data-url="{{ route('web.log-recording.destroy', $logRecording->uuid) }}"><i
                                                    class="fa fa-trash"></i></a>
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
    <div class="modal fade" id="addLogRecordingModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <form action="{{ route('web.log-recording.store') }}" method="post" id="formAddliveCounseling">
                    @csrf
                    <input type="hidden" value="{{ $liveCounseling->uuid }}" name="live_class_id">
                    <input type="hidden" name="isCounseling" value="true">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Link Recording</label>
                            <input type="text" class="form-control input-rounded shadow-sm" name="link_recording"
                                value="{{ old('link_recording') }}">
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
        (function($, W, D) {
            var JQUERY4U = {};
            JQUERY4U.UTIL = {
                setupFormValidation: function() {
                    $("#formAddliveCounseling").validate({
                        ignore: "",
                        rules: {
                            link_recording: {
                                required: true,
                            },
                        },
                        messages: {
                            link_recording: {
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
