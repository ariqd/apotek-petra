<div>
    <div class="card">
        <div class="card-header justify-content-between">
            <h4>Keranjang</h4>
            <a href="" class="text-danger" wire:click.prevent="clearRestock">Remove all</a>
        </div>
        <div class="card-body">
            @forelse($cart->content() as $obat)
                <div class="row mb-4 no-gutters" wire:key="{{ $loop->index }}">
                    <div class="col-5 text-center">
                        <div>
                            @if(file_exists(asset($obat->options->image)))
                                <img
                                    src="{{ asset($obat->options->image) }}"
                                    class="w-50 img-fluid mx-auto d-block" alt="{{ $obat->name }}">
                            @else
                                <img
                                    src="https://via.placeholder.com/100?text=No+image"
                                    class="img-fluid mx-auto d-block" alt="{{ $obat->name }}">
                            @endif
                        </div>
                        <div class="mt-1 font-weight-bold">{{ $obat->name }}</div>
                        <div class="mt-1" wire:key="currentPrice_{{ $loop->index }}">
                            Rp {{ number_format($obat->options->currentPrice, 0, ',', '.') }}
                        </div>
                        <div class="mt-1" wire:key="currentStock_{{ $loop->index }}">{{ $obat->options->currentStock }}
                            pcs
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label for="harga_beli" class="col-form-label">Harga beli</label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                </div>
                                <input
                                    wire:key="price_{{ $loop->index }}"
                                    type="number"
                                    id="harga_beli"
                                    class="form-control form-control-sm"
                                    placeholder="Harga beli"
                                    value="{{ $obat->options->currentPrice == $obat->price ? $obat->options->currentPrice : $obat->price }}"
                                    min="0"
                                    wire:change="updatePriceRestock('{{ $obat->rowId }}', $event.target.value, {{ $obat->id }})">
                            </div>
                            <label for="expiry_date" class="col-form-label">Kadaluarsa</label>
                            <input
                                wire:key="expiry_date_{{ $loop->index }}"
                                type="date"
                                class="form-control form-control-sm"
                                placeholder="Kadaluarsa"
                                id="expiry_date"
                                value="{{ $obat->options->expiry_date }}"
                                wire:change="updateExpiryRestock('{{ $obat->rowId }}', $event.target.value, {{ $obat->id }})"
                                min="{{ date('Y-m-d') }}">
                            <label for="qty" class="col-form-label">Qty restock</label>
                            <div class="input-group input-group-sm">
                                <input
                                    wire:key="qty_restock_{{ $loop->index }}"
                                    type="number"
                                    id="qty"
                                    class="form-control form-control-sm"
                                    placeholder="Qty Obat"
                                    value="{{ $obat->qty }}" min="0"
                                    wire:change="updateQtyRestock('{{ $obat->rowId }}', $event.target.value, {{ $obat->id }})">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon1">pcs</span>
                                </div>
                            </div>
                            <div>
                                @error('qty_error.'.$obat->rowId)
                                <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-2 text-right">
                        <button class="btn btn-danger btn-sm" wire:click="deleteFromRestock('{{ $obat->rowId }}')">
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
                <div class="col-9 font-weight-bold text-right" wire:loading wire:target="updateQtyRestock,updatePriceRestock">
                    loading...
                </div>
                <div class="col-9 font-weight-bold text-right" wire:loading.remove wire:target="updateQtyRestock,updatePriceRestock">
                    Rp {{ @$cart->total() }}
                </div>
            </div>
            <div class="row align-items-center mb-3">
                <div class="col-3">
                    <label for="supplier_id" class="col-form-label">Supplier</label>
                </div>
                <div class="col-9" wire:ignore>
                    <select class="form-control"
                            wire:model="supplier_id"
                            id="supplierId">
                        <option value="0" selected disabled>Pilih Supplier</option>
                        @foreach($suppliers as $supplier)
                            <option value={{ $supplier->id }}>{{ $supplier->nama }}</option>
                        @endforeach
                    </select>
                    @error('supplier_id') <small class="invalid-feedback">{{ $message }}</small> @enderror
                </div>
            </div>
            <button
                class="btn btn-primary btn-block {{ $cart->count() <= 0 || $supplier_id == 0 ? 'disabled' : '' }}"
                {{ $cart->count() <= 0 || $supplier_id == 0 ? 'disabled' : '' }} wire:click.prevent="$emit('restockButtonClicked')">
                <i class="fa fa-check"></i> Restock
            </button>
        </div>
    </div>
</div>
