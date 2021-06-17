<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Stok {{ $obat->name }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
        <h1 id="modal-loader" style="display: none; text-align: center;">
            <i class="fas fa-spinner fa-pulse fa-3x"></i>
        </h1>

        <form action="{{ route('obat.update', $obat) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Tambahan Stok</label>
                <div class="input-group mb-3">
                    <input type="number" class="form-control" name="add_stock" id="stock"
                        placeholder="Jumlah Tambahan Stok (dalam pcs)" aria-label="Harga" aria-describedby="basic-addon1">
                    <span class="input-group-text bg-primary text-light" id="basic-addon1">pcs</span>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary">Simpan Stok</button>
    </div>
</div>
