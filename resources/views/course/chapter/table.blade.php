@php
    $paginator = json_decode($chapters);
@endphp
<div class="d-md-flex justify-content-between align-items-center" id="filter">
    <div class="me-md-2 me-0"><input type="search" class="form-control" placeholder="pencarian" id="searching"
            value="{{ $search }}"></div>
    <nav class="d-flex align-items-center justify-content-md-end justify-content-center">
        <p class="me-2 mt-2">{{ $paginator->from }} - {{ $paginator->to }}</p>
        <p class="me-2 mt-2">dari</p>
        <p class="mt-2">{{ $paginator->total }}</p>
        <p class="mt-2 {{ $paginator->current_page - 1 == 0 ? 'pointer-block' : '' }}"><button class="btn no-border "
                onclick="pageChange({{ $paginator->per_page - 1 }})"
                {{ $paginator->current_page - 1 == 0 ? 'disabled' : '' }}><svg xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-arrow-left-circle">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 8 8 12 12 16"></polyline>
                    <line x1="16" y1="12" x2="8" y2="12"></line>
                </svg></button></p>
        <p class="mt-2 {{ $paginator->current_page == $paginator->last_page ? 'pointer-block' : '' }}"><button
                class="btn show-block " onclick="pageChange({{ $paginator->per_page + 1 }})"
                {{ $paginator->current_page == $paginator->last_page ? 'disabled' : '' }}><svg
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-arrow-right-circle">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 16 16 12 12 8"></polyline>
                    <line x1="8" y1="12" x2="16" y2="12"></line>
                </svg></button></p>
    </nav>
</div>

<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th style="width:80px;"><strong>#</strong></th>
                <th><strong>BAB</strong></th>
                @hasanyrole(['Admin', 'Guru'])
                    <th><strong>Dokumen</strong></th>
                    <th><strong>Upload Kuis</strong></th>
                    <th></th>
                @endhasanyrole
            </tr>
        </thead>
        <tbody>
            @php
                $index = 0;
            @endphp
            @foreach ($paginator->data as $key => $chapter)
                <tr
                    @role('Siswa') style="cursor: pointer" onclick="redirect('{{ route('web.chapter.show.slug', ['chapterSlug' => $chapter->chapter_slug, 'courseSlug' => $chapter->course->course_slug]) }}')" @endrole>
                    <td><strong>{{ $index = $paginator->current_page + $key }}</strong></td>
                    <td>{{ $chapter->chapter_name }}</td>
                    @hasanyrole(['Admin', 'Guru'])
                        <td>
                            @if ($chapter->document)
                                <a href="{{ asset('storage/' . $chapter->document->document_path) }}" target="_blank"
                                    class="btn btn-rounded btn-primary"><span class="btn-icon-start text-primary"><i
                                            class="fa fa-file-pdf"></i>
                                    </span>Dokumen</a>
                            @else
                                <p>Tidak ada dokumen</p>
                            @endif
                        </td>
                        <td>
                            <a href="#" class="btn btn-rounded btn-info btn-quiz" data-bs-toggle="modal"
                                data-bs-target="#addQuizModal" data-courseid="{{ $chapter->course->uuid }}"
                                data-chapterid="{{ $chapter->uuid }}"
                                data-quiz="{{ $chapter->quiz ? $chapter->quiz->link_quiz : '' }}"><span
                                    class="btn-icon-start text-info"><i class="fa fa-upload"></i>
                                </span>Upload</a>
                        </td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('web.chapter.edit', ['id' => $courseId, 'chapter' => $chapter->uuid]) }}"
                                    class="btn btn-warning text-white shadow btn-xs sharp me-1"><i
                                        class="fas fa-pencil-alt"></i></a>
                                <a href="#" class="btn btn-danger shadow btn-xs sharp btn-delete"
                                    data-url="{{ route('web.chapter.destroy', ['id' => $courseId, 'chapter' => $chapter->uuid]) }}"><i
                                        class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    @endhasanyrole
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
