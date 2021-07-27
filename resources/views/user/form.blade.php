<div class="modal-content">
    <form action="{{ $edit ? route('users.update', $user) : route('users.store') }}" method="POST">
        @csrf
        {{ $edit ? method_field('PUT') : '' }}
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ $edit ? 'Edit' : 'Tambah' }}
                User {{ $edit ? $user->name : '' }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="name">Nama User</label>
                <input type="text" class="form-control" name="name" id="name"
                       value="{{ $edit ? $user->name : old('name') }}" placeholder="Nama User" autofocus>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" id="email"
                       value="{{ $edit ? $user->email : old('email') }}" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" id="role" class="form-control" {{ $edit && Auth::id() == $user->id ? 'disabled' : '' }}>
                    <option value="Kasir" {{ $edit && $user->role == 'Kasir' ? 'selected' : '' }}>Kasir</option>
                    <option value="Pemilik" {{ $edit && $user->role == 'Pemilik' ? 'selected' : '' }}>Pemilik</option>
                    <option value="Apoteker" {{ $edit && $user->role == 'Apoteker' ? 'selected' : '' }}>Apoteker</option>
                </select>
            </div>
            <div class="form-group">
                <label for="password">{{ $edit ? 'Ganti' : '' }} Password {{ $edit ? '(Opsional)' : '' }}</label>
                <input id="password" type="password" class="form-control" name="password"
                       {{ $edit ? '' : 'required' }} autocomplete="current-password" placeholder="Ketik password">
                <div class="invalid-feedback">
                    please fill in your password
                </div>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Konfirmasi {{ $edit ? 'Ganti' : '' }}
                    Password</label>
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation"
                       {{ $edit ? '' : 'required' }} autocomplete="password_confirmation"
                       placeholder="Ketik ulang password">
                <div class="invalid-feedback">
                    please fill in your password
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan Data User</button>
        </div>
    </form>
</div>
