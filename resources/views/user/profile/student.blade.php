<div class="card">
    <div class="card-body">
        <div class="mb-4 row">
            <label class="col-sm-3 col-form-label fw-bold text-dark">Nama Lengkap</label>
            <div class="col-sm-9">
                <input type="text" class="form-control input-rounded shadow" name="name" value="{{ $user->name }}">
                @error('name')
                    <label id="name-error" class="error" for="name">{{ $message }}</label>
                @enderror
            </div>
        </div>
        <div class="mb-4 row">
            <label class="col-sm-3 col-form-label fw-bold text-dark">Tempat Lahir</label>
            <div class="col-sm-9">
                <input type="text" class="form-control input-rounded shadow" name="birth_place"
                    value="{{ $user->student->birth_place }}">
                @error('birth_place')
                    <label id="birth_place-error" class="error" for="birth_place">{{ $message }}</label>
                @enderror
            </div>
        </div>
        <div class="mb-4 row">
            <label class="col-sm-3 col-form-label fw-bold text-dark">Tanggal Lahir</label>
            <div class="col-sm-9">
                <input type="date" class="form-control input-rounded shadow" name="date_birth"
                    value="{{ $user->student->date_birth }}">
                @error('date_birth')
                    <label id="date_birth-error" class="error" for="date_birth">{{ $message }}</label>
                @enderror
            </div>
        </div>
        <div class="mb-4 row">
            <label class="col-sm-3 col-form-label fw-bold text-dark">Kelas</label>
            <div class="col-sm-9">
                <input type="text" class="form-control input-rounded shadow" name="class"
                    value="{{ $user->student->class }}">
                @error('class')
                    <label id="class-error" class="error" for="class">{{ $message }}</label>
                @enderror
            </div>
        </div>
        <div class="mb-4 row">
            <label class="col-sm-3 col-form-label fw-bold text-dark">Asal Sekolah</label>
            <div class="col-sm-9">
                <input type="text" class="form-control input-rounded shadow" name="school"
                    value="{{ $user->student->school }}">
                @error('school')
                    <label id="school-error" class="error" for="school">{{ $message }}</label>
                @enderror
            </div>
        </div>
        <div class="mb-4 row">
            <label class="col-sm-3 col-form-label fw-bold text-dark">No Telepon</label>
            <div class="col-sm-9">
                <input type="number" class="form-control input-rounded shadow" name="phone"
                    value="{{ $user->student->phone }}">
                @error('phone')
                    <label id="phone-error" class="error" for="phone">{{ $message }}</label>
                @enderror
            </div>
        </div>
        <div class="mb-4 row">
            <label class="col-sm-3 col-form-label fw-bold text-dark">Email</label>
            <div class="col-sm-9">
                <input type="email" class="form-control input-rounded shadow" name="email"
                    value="{{ $user->student->birth_place }}">
                @error('email')
                    <label id="email-error" class="error" for="email">{{ $message }}</label>
                @enderror
            </div>
        </div>
        <div class="mb-4 row">
            <label class="col-sm-3 col-form-label fw-bold text-dark">Password</label>
            <div class="col-sm-9">
                <input type="password" class="form-control input-rounded shadow" name="password">
                @error('password')
                    <label id="password-error" class="error" for="password">{{ $message }}</label>
                @enderror
            </div>
        </div>
    </div>
</div>
