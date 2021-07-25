<div class="modal-content">
    <form action="{{ $edit ? route('supplier.update', $supplier) : route('supplier.store') }}" method="POST">
        @csrf
        {{ $edit ? method_field('PUT') : '' }}
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ $edit ? 'Edit' : 'Tambah' }}
                Supplier {{ $edit ? $supplier->nama : '' }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <h1 id="modal-loader" style="display: none; text-align: center;">
                <i class="fas fa-spinner fa-pulse fa-3x"></i>
            </h1>
            <div class="form-group">
                <label for="nama">Nama Supplier</label>
                <input type="text" class="form-control" name="nama" id="nama"
                       value="{{ $edit ? $supplier->nama : old('nama') }}" placeholder="Nama Supplier" autofocus>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" name="alamat" id="alamat"
                       value="{{ $edit ? $supplier->alamat : old('alamat') }}" placeholder="Alamat">
            </div>
            <div class="form-group">
                <label for="no_telp">No. Telepon</label>
                <input type="text" class="form-control" name="no_telp" id="no_telp"
                       value="{{ $edit ? $supplier->no_telp : old('no_telp') }}" placeholder="No. Telepon">
            </div>
            <div class="form-group">
                <label for="kota">Kota</label>
                <input type="text" class="form-control" name="kota" id="kota"
                       value="{{ $edit ? $supplier->kota : old('kota') }}" placeholder="Kota">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan Data Supplier</button>
        </div>
    </form>
</div>
