<form action="{{ route('web.admin.update', $user->uuid) }}" method="post">
    @csrf
    @method('put')
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="name" class="form-control input-rounded shadow-sm"
                    value="{{ $user->name }}">
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="text" name="email" class="form-control input-rounded shadow-sm"
                    value="{{ $user->email }}">
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button class="btn btn-secondary">Simpan</button>
        </div>
    </div>

</form>
