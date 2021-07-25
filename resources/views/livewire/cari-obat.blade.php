<div>
    <div class="card">
        <div class="card-header">
            <h4>Cari obat</h4>
        </div>

        <div class="card-body">
            <div class="form-group">
                <label for="search">Ketik nama obat</label>
                <input type="text" class="form-control" placeholder="Ketik nama obat"
                       wire:change.lazy="$emit('showLoading')"
                       id="search" wire:model="search">
                <small class="text-muted">Minimal 3 karakter</small>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table mb-0 table-hover">
                <tbody>
                @forelse($obats as $obat)
                    <tr scope="row">
                        <td class="w-25 p-2">
                            @if(file_exists(asset($obat->image)))
                                <img
                                    src="{{ asset($obat->image) }}"
                                    class="w-50 img-fluid mx-auto d-block" alt="{{ $obat->name }}">
                            @else
                                <img
                                    src="https://via.placeholder.com/50?text=No+image"
                                    class="img-fluid mx-auto d-block" alt="{{ $obat->name }}">
                            @endif
                        </td>
                        <td class="align-middle">
                            <div class="font-weight-bold">{{ $obat->name }}</div>
                            <div>Rp {{ number_format($obat->price, 0, ',', '.') }}</div>
                        </td>
                        <td class="align-middle">
                            <div class="font-weight-bold">Stok: {{ $obat->stock }} {{ $obat->type }}</div>
                            <div>Reorder Point: {{ $obat->reorder_point }} {{ $obat->type }}</div>
                        </td>
                        <td class="text-center">
                            @if($obat->stock <= 0)
                                <div class="text-danger">
                                    <small>
                                        Stok habis
                                    </small>
                                </div>
                            @else
                                <div wire:loading.remove>
                                    <button class="btn btn-primary"
                                            wire:click="$emit('addToCartButtonClick', {{ $obat->id }})"
                                    >
                                        <i class="fa fa-plus"></i>
                                        Keranjang
                                    </button>
                                </div>
                                <div wire:loading>
                                    Loading...
                                </div>
                                @if($obat->stock < $obat->reorder_point)
                                    <div class="text-danger mt-2">
                                        <small>
                                            Stok dibawah Reorder Point
                                        </small>
                                    </div>
                                @endif
                            @endif
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
