<div>
    <div class="card">
        <div class="card-header justify-content-between">
            <h4>Keranjang belanja</h4>
            <a href="" class="text-danger" wire:click.prevent="clearCart">Remove all</a>
        </div>
        <div class="card-body">
            @forelse(Cart::content() as $obat)
                @php
                    if ($obat->options->max < $obat->qty || $obat->qty <= 0) {
                        $error_count++;
                    }
                @endphp
                <div class="row mb-4">
                    <div class="col-3 text-right">
                        <img
                            src="{{ asset($obat->options->image) }}"
                            class="w-50 img-fluid mx-auto d-block" alt="{{ $obat->name }}">
                    </div>
                    <div class="col-6">
                        <div class="mb-1 font-weight-bold">{{ $obat->name }}</div>
                        <div class="mb-1">
                            Rp {{ number_format($obat->price, 0, ',', '.') }}
                        </div>
                        <div class="input-group input-group-sm">
                            <input type="number"
                                   class="form-control form-control-sm {{ $obat->options->max < $obat->qty ? 'is-invalid' : '' }}"
                                   placeholder="Qty Obat"
                                   value={{ $obat->qty }} max={{ $obat->options->max }} min="0"
                                   wire:change.prevent="updateQty('{{ $obat->rowId }}', $event.target.value, {{ $obat->id }})">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon1">pcs</span>
                            </div>
                        </div>
                        <div
                            class="text-small {{ $obat->options->max < $obat->qty ? 'text-danger' : 'text-muted' }}">
                            Max {{ $obat->options->max }} pcs.
                        </div>
                    </div>
                    <div class="col-3 text-right">
                        <button class="btn btn-danger btn-sm" wire:click="deleteFromCart('{{ $obat->rowId }}')">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>
            @empty
                <div class="text-muted py-4 text-center">
                    Keranjang kosong
                </div>
            @endforelse
        </div>
        <div class="card-footer">
            <div class="row align-items-center mb-3">
                <div class="col-3">Total</div>
                <div class="col-9 font-weight-bold text-right">
                    Rp {{ @Cart::total() }}
                </div>
            </div>
            <div class="row align-items-center mb-3">
                <div class="col-3">
                    <label for="nama_pembeli" class="col-form-label">Pembeli</label>
                </div>
                <div class="col-9">
                    <input type="text" class="form-control @error('nama_pembeli') is-invalid @enderror"
                           placeholder="Nama pembeli" wire:model="nama_pembeli" id="nama_pembeli">
                    @error('nama_pembeli') <small class="invalid-feedback">{{ $message }}</small> @enderror
                </div>
            </div>
            <button class="btn btn-primary btn-block"
                    {{ $error_count > 0 || Cart::count() <= 0 ? 'disabled' : '' }} wire:click.prevent="$emit('checkoutButtonClicked')">
                <i class="fa fa-check"></i> Checkout
            </button>
        </div>
    </div>
</div>
