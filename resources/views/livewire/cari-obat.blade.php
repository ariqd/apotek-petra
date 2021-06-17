<div>
    <div class="card">
        <div class="card-header">
            <h4>Cari obat</h4>
        </div>

        <div class="card-body">
            <div class="form-group">
                <label for="search">Ketik nama obat</label>
                <input type="text" class="form-control" placeholder="Ketik nama obat" wire:model="search" id="search">
                <small class="text-muted">Minimal 3 karakter</small>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table mb-0 table-hover">
                <tbody>
                    @forelse($obats as $obat)
                    <tr scope="row">
                        <td class="w-25 p-2">
                            <img src="https://cms.sehatq.com/cdn-cgi/image/f=auto,width=589,fit=pad,background=white,quality=100/public/img/drugbrand_img/stimuno-sirup-60-ml-01-1571106213.jpg"
                                class="w-50 mx-auto d-block" alt="singleminded">
                        </td>
                        <td class="align-middle">
                            <div class="font-weight-bold">{{ $obat->name }}</div>
                            <div>Rp {{ number_format($obat->price, 0, ',', '.') }}</div>
                        </td>
                        <td class="align-middle">{{ $obat->stock }} {{ $obat->type }}</td>
                        <td class="text-center">
                            <button class="btn btn-primary" wire:click="cartButton({{ $obat->id }})">
                                <i class="fa fa-plus"></i> Keranjang
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">
                            <div class="text-muted text-center">
                                Obat akan muncul di sini
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
