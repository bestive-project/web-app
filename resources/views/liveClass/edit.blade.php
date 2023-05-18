@role('Admin')
    <div class="mb-3">
        <label>Penanggung Jawab</label>
        <select name="user_id" class="form-select input-rounded shadow-sm">
            <option selected disabled></option>
            @foreach ($teachers as $teacher)
                <option value="{{ $teacher->uuid }}" {{ $teacher->id == $liveClass->user_id ? 'selected' : '' }}>
                    {{ $teacher->name }}</option>
            @endforeach
        </select>
    </div>
    @elserole("Guru")
    <input type="hidden" name="user_id" value="{{ auth()->user()->uuid }}">
@endrole
<div class="mb-3">
    <label>Kelompok Belajar</label>
    <select name="study_group_id" class="form-select input-rounded shadow-sm">
        <option selected disabled></option>
        @foreach ($studyGroups as $studyGroup)
            <option value="{{ $studyGroup->uuid }}"
                {{ $liveClass->study_group_id == $studyGroup->id ? 'selected' : '' }}>{{ $studyGroup->name }}</option>
        @endforeach
    </select>
</div>
<div class="row">
    <label>Jadwal Live Class</label>
    <div class="col-lg-6">
        <div class="mb-3">
            <select name="day" class="form-select input-rounded shadow-sm">
                <option disabled></option>
                <option value="Senin" {{ $liveClass->day == 'Senin' ? 'selected' : '' }}>Senin</option>
                <option value="Selasa" {{ $liveClass->day == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                <option value="Rabu" {{ $liveClass->day == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                <option value="Kamis" {{ $liveClass->day == 'Kamin' ? 'selected' : '' }}>Kamis</option>
                <option value="Jumat" {{ $liveClass->day == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                <option value="Sabtu" {{ $liveClass->day == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                <option value="Minggu" {{ $liveClass->day == 'Minggu' ? 'selected' : '' }}>Minggu</option>
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <input type="time" class="form-control input-rounded shadow-sm" name="hour"
                value="{{ $liveClass->hour }}">
        </div>
    </div>
</div>
<div class="mb-3">
    <label>Link Meet</label>
    <input type="text" class="form-control input-rounded shadow-sm" name="link_meet"
        value="{{ $liveClass->link_meet }}">
</div>
