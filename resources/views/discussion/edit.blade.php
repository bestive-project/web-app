<div class="mb-3">
    <label>Kelompok Belajar</label>
    <select name="study_group_id" class="form-select input-rounded shadow-sm">
        <option value="" disabled selected></option>
        @foreach ($studyGroups as $studyGroup)
            <option value="{{ $studyGroup->uuid }}"
                {{ $studyGroup->id == $discussion->study_group_id ? 'selected' : '' }}>{{ $studyGroup->name }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label>WA Link</label>
    <input type="text" name="wa_link" class="form-control input-rounded shadow-sm" value="{{ $discussion->wa_link }}">
</div>
<div class="mb-3">
    <label>Discord Link</label>
    <input type="text" name="discord_link" class="form-control input-rounded shadow-sm"
        value="{{ $discussion->discord_link }}">
</div>
