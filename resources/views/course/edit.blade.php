<div class="pt-3">
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

    <form action="{{ route('web.course.update', $course->uuid) }}" method="post" id="formEditCourse">
        @csrf
        @method('put')
        <div class="mb-3">
            <label>Mata Pelajaran</label>
            <select name="category_id" class="form-select">
                <option selected disabled></option>
                @foreach ($categories as $category)
                    <option value="{{ $category->uuid }}"
                        {{ $course->category->uuid == $category->uuid ? 'selected' : '' }}>
                        {{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Judul Materi</label>
            <input type="text" class="form-control" name="course_name" value="{{ $course->course_name }}">
        </div>
        <div class="mb-3 custom-ekeditor">
            <label>Deskripsi Materi</label>
            <textarea id="ckeditor" name="course_description">{{ $course->course_description }}</textarea>
        </div>
        <div class="">
            <button class="btn btn-secondary">Simpan</button>
        </div>
    </form>

</div>

@push('js')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script>
        (function($, W, D) {
            var JQUERY4U = {};
            JQUERY4U.UTIL = {
                setupFormValidation: function() {
                    $("#formEditCourse").validate({
                        ignore: "",
                        rules: {
                            course_name: {
                                required: true,
                            },
                            course_description: {
                                required: true,
                            },
                        },
                        messages: {
                            course_name: {
                                required: "judul materi harap di isi!",
                            },
                            course_description: {
                                required: "deskripsi materi harap di isi!",
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
