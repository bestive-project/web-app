@php
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

@extends('template.app')

@section('content')
    <div class="row ">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Permasalahan dari {{ $helpCenter->assignFrom->name }}</h4>
                    <a href="{{ route('web.help-center.index') }}" class="btn btn-warning text-white">Kembali</a>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label>Permasalahan</label>
                        <input type="text" disabled value="{{ convertType($helpCenter->type) }}" class="form-control">
                    </div>
                    @if ($helpCenter->assignTo)
                        <div class="mb-3">
                            <label>Tujuan</label>
                            <input type="text" disabled value="{{ $helpCenter->assignTo->name }}" class="form-control">
                        </div>
                    @endif
                    <div class="mb-3">
                        <label>Deskripsi Permasalahan</label>
                        <textarea class="form-control" rows="5" disabled>{{ $helpCenter->message }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
