@php
    $paginator = json_decode($studyGroups);
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
<table class="table table-responsive-md">
    <thead>
        <tr>
            <th style="width:80px;"><strong>#</strong></th>
            <th><strong>Nama Kelompok</strong></th>
            <th><strong>Jumlah Siswa</strong></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @php
            $index = 0;
        @endphp
        @foreach ($paginator->data as $key => $studyGroup)
            <tr>
                <td><strong>{{ $index = $paginator->current_page + $key }}</strong></td>
                <td>{{ $studyGroup->name }}</td>
                <td><span class="badge light badge-secondary">{{ count($studyGroup->students) }} Siswa</span></td>
                <td>
                    <div class="d-flex">
                        <a href="#" class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal"
                            data-bs-target="#editStudyGroupModal"><i class="fas fa-pencil-alt"
                                data-url="{{ route('web.study-group.show', $studyGroup->uuid) }}"
                                id="editStudyGroupBtn"></i></a>
                        <a href="#" class="btn btn-danger shadow btn-xs sharp btn-delete"
                            data-url="{{ route('web.study-group.destroy', $studyGroup->uuid) }}"><i
                                class="fa fa-trash"></i></a>
                    </div>
                </td>
            </tr>
        @endforeach
        <tr>
            <td><strong>{{ $index + 1 }}</strong></td>
            <td>Belum dapat kelompok</td>
            <td><span class="badge light badge-secondary">{{ $studentWithoutGroup->count() }} Siswa</span></td>
            <td></td>
        </tr>
    </tbody>
</table>
