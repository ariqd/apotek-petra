<div>

    <div class="card">
        <div class="card-header">
            <h4>Keranjang belanja</h4>
        </div>
        <div class="card-body">
            @forelse($cart as $obat)
            <div class="row mb-4">
                <div class="col-3 text-right">
                    <img src="https://cms.sehatq.com/cdn-cgi/image/f=auto,width=589,fit=pad,background=white,quality=100/public/img/drugbrand_img/stimuno-sirup-60-ml-01-1571106213.jpg"
                        class="img-fluid" alt="preview">
                </div>
                <div class="col-6">
                    <div class="mb-1 font-weight-bold">{{ $obat->name }}</div>
                    <div class="mb-1">
                        Rp {{ number_format($obat->price, 0, ',', '.') }}
                    </div>
                    <div class="input-group input-group-sm">
                        <input type="number" class="form-control form-control-sm" placeholder="Qty Obat"
                            value={{ $obat->stock }}>
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon1">pcs</span>
                        </div>
                    </div>
                </div>
                <div class="col-3 text-right">
                    <a href="#" class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i>
                    </a>
                </div>
            </div>
            @empty
            <div class="text-muted py-4 text-center">
                Keranjang kosong
            </div>
            @endforelse
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-primary btn-block"><i class="fa fa-check"></i> Checkout</button>
        </div>
    </div>
</div>
