<div class="mb-3">
    @role('Admin')
        <div class="mb-3">
            <label>Penanggung Jawab</label>
            <select name="user_id" class="form-select input-rounded shadow-sm">
                <option selected disabled></option>
                @foreach ($counselors as $counselor)
                    <option value="{{ $counselor->uuid }}"
                        {{ $liveCounseling->user_id == $counselor->id ? 'selected' : '' }}>{{ $counselor->name }}</option>
                @endforeach
            </select>
        </div>
        @elserole("Konselor")
        <input type="hidden" name="user_id" value="{{ auth()->user()->uuid }}">
    @endrole
    <label>Kelompok Belajar</label>
    <select name="study_group_id" class="form-select input-rounded shadow-sm">
        <option selected disabled></option>
        @foreach ($studyGroups as $studyGroup)
            <option value="{{ $studyGroup->uuid }}"
                {{ $liveCounseling->study_group_id == $studyGroup->id ? 'selected' : '' }}>{{ $studyGroup->name }}
            </option>
        @endforeach
    </select>
</div>
<div class="row">
    <label>Jadwal Live Class</label>
    <div class="col-lg-6">
        <div class="mb-3">
            <select name="day" class="form-select input-rounded shadow-sm">
                <option disabled></option>
                <option value="Senin" {{ $liveCounseling->day == 'Senin' ? 'selected' : '' }}>Senin</option>
                <option value="Selasa" {{ $liveCounseling->day == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                <option value="Rabu" {{ $liveCounseling->day == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                <option value="Kamis" {{ $liveCounseling->day == 'Kamin' ? 'selected' : '' }}>Kamis</option>
                <option value="Jumat" {{ $liveCounseling->day == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                <option value="Sabtu" {{ $liveCounseling->day == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                <option value="Minggu" {{ $liveCounseling->day == 'Minggu' ? 'selected' : '' }}>Minggu</option>
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <input type="time" class="form-control input-rounded shadow-sm" name="hour"
                value="{{ $liveCounseling->hour }}">
        </div>
    </div>
</div>
<div class="mb-3">
    <label>Link Meet</label>
    <input type="text" class="form-control input-rounded shadow-sm" name="link_meet"
        value="{{ $liveCounseling->link_meet }}">
</div>
