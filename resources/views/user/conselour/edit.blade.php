<div class="mb-3">
    <label>Nama Lengkap</label>
    <input type="text" name="name" class="form-control input-rounded shadow-sm" value="{{ $user->name }}">
</div>
<div class="mb-3">
    <label>Usia</label>
    <input type="text" name="age" class="form-control input-rounded shadow-sm" value="{{ $user->counselor->age }}">
</div>
<div class="mb-3">
    <label>Pendidikan</label>
    <input type="text" name="study" class="form-control input-rounded shadow-sm"
        value="{{ $user->counselor->study }}">
</div>
<div class="mb-3">
    <label>Jurusan</label>
    <input type="text" name="major" class="form-control input-rounded shadow-sm"
        value="{{ $user->counselor->major }}">
</div>
<div class="mb-3">
    <label>Email</label>
    <input type="text" name="email" class="form-control input-rounded shadow-sm" value="{{ $user->email }}">
</div>
