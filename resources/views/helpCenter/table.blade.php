@php
    use Illuminate\Support\Str;
    $paginator = json_decode($helpCenters);
    
    function convertType($type)
    {
        switch ($type) {
            case 'OTHER':
                return 'Permasalah Lainnya';
                break;
            case 'COUNSELING':
                return 'Permasalah Konseling';
                break;
            case 'TEACHER':
                return 'Permasalah Pembelajaran';
                break;
    
            default:
                return 'Permasalah Lainnya';
                break;
        }
    }
@endphp
<div class="d-md-flex justify-content-between align-items-center">
    <div class="mb-3" style="margin-top: -10px">
        <select name="" class="form-select" id="typeSearch">
            <option selected disabled>Pilih Tipe Permasalahan</option>
            <option value="OTHER" {{ request('tipe') == 'OTHER' ? 'selected' : '' }}>Permasalah Lainnya</option>
            <option value="COUNSELING" {{ request('tipe') == 'COUNSELING' ? 'selected' : '' }}>Permasalah Konseling
            </option>
            <option value="TEACHER" {{ request('tipe') == 'TEACHER' ? 'selected' : '' }}>Permasalah Pembelajaran</option>
        </select>
    </div>
    <div class="d-md-flex align-items-center" id="filter">
        <div class="me-md-2 me-0"><input type="search" class="form-control" placeholder="pencarian" id="searching"
                value="{{ $search }}"></div>
        <nav class="d-flex align-items-center justify-content-md-end justify-content-center">
            <p class="me-2 mt-2">{{ $paginator->from }} - {{ $paginator->to }}</p>
            <p class="me-2 mt-2">dari</p>
            <p class="mt-2">{{ $paginator->total }}</p>
            <p class="mt-2 {{ $paginator->current_page - 1 == 0 ? 'pointer-block' : '' }}"><button
                    class="btn no-border " onclick="pageChange({{ $paginator->per_page - 1 }})"
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
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-arrow-right-circle">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 16 16 12 12 8"></polyline>
                        <line x1="8" y1="12" x2="16" y2="12"></line>
                    </svg></button></p>
        </nav>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th style="width:80px;"><strong>#</strong></th>
                <th><strong>Permasalahan</strong></th>
                <th><strong>Pengusul</strong></th>
                <th><strong>Tujuan</strong></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @php
                $index = 0;
            @endphp
            @foreach ($paginator->data as $key => $helpCenter)
                <tr>
                    <td><strong>{{ $index = $paginator->current_page + $key }}</strong></td>
                    <td>{{ convertType($helpCenter->type) }}</td>
                    <td>{{ $helpCenter->assign_from ? $helpCenter->assign_from->name : '-' }}</td>
                    <td>{{ $helpCenter->assign_to ? $helpCenter->assign_to->name : '-' }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('web.help-center.show', $helpCenter->uuid) }}"
                                class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-eye"></i></a>
                            <a href="#" class="btn btn-danger shadow btn-xs sharp btn-delete"
                                data-url="{{ route('web.help-center.destroy', $helpCenter->uuid) }}"><i
                                    class="fa fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
