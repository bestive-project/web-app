@extends('template.app')

@push('css')
    <style>
        .custom-ekeditor .error {}
    </style>
@endpush

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

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit BAB {{ $chapter->chapter_name }}</h4>
        </div>
        <form action="{{ route('web.chapter.update', ['id' => $chapter->course->uuid, 'chapter' => $chapter->uuid]) }}"
            method="post" id="formEditChapter" enctype="multipart/form-data">
            <div class="card-body">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label>Judul BAB</label>
                    <input type="text" class="form-control" name="chapter_name" value="{{ $chapter->chapter_name }}">
                </div>
                <div class="mb-3 custom-ekeditor">
                    <label>Deskripsi BAB</label>
                    <textarea id="ckeditor" name="chapter_description">{{ $chapter->chapter_description }}</textarea>
                </div>
                <div class="mb-3">
                    <label>Dokumen <span style="font-size: 10px">Opsional</span></label>
                    <div class="form-file mb-2">
                        <input type="file" class="form-file-input form-control" name="chapter_document">
                    </div>
                    @if ($chapter->document)
                        <a href="{{ asset('storage/' . $chapter->document->document_path) }}" target="_blank"
                            class="btn btn-rounded btn-primary"><span class="btn-icon-start text-primary"><i
                                    class="fa fa-file-pdf"></i>
                            </span>Dokumen Sebelumnya</a>
                    @endif
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('web.course.show', $chapter->course->uuid) }}"
                    class="btn btn-warning text-white">Kembali</a>
                <button class="btn btn-secondary">Simpan</button>
            </div>
        </form>
    </div>
@endsection


@push('js')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script>
        (function($, W, D) {
            var JQUERY4U = {};
            JQUERY4U.UTIL = {
                setupFormValidation: function() {
                    $("#formEditChapter").validate({
                        ignore: "",
                        rules: {
                            chapter_name: {
                                required: true,
                            },
                            chapter_description: {
                                required: true,
                            },
                            chapter_document: {
                                extension: "pdf"
                            }
                        },
                        messages: {
                            chapter_name: {
                                required: "judul bab harap di isi!",
                            },
                            chapter_description: {
                                required: "deskripsi bab harap di isi!",
                            },
                            chapter_document: {
                                extension: "masukan jenis file .pdf"
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
