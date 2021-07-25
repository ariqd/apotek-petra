<div>
    <x-slot name="livewireCss">
        <link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
        <style>
            .select2-container--default .select2-search--dropdown .select2-search__field:focus {
                outline: none;
                box-shadow: none;
            }

            .select2-container .select2-selection--multiple, .select2-container .select2-selection--single {
                box-sizing: border-box;
                cursor: pointer;
                display: block;
                min-height: 42px;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                -webkit-user-select: none;
                outline: none;
                background-color: #fdfdff;
                border-color: #e4e6fc;
            }

            .select2-dropdown {
                border-color: #e4e6fc !important;
            }

            .select2-container.select2-container--open .select2-selection--multiple {
                background-color: #fefeff;
                border-color: #95a0f4;
            }

            .select2-container.select2-container--focus .select2-selection--multiple, .select2-container.select2-container--focus .select2-selection--single {
                background-color: #fefeff;
                border-color: #95a0f4;
            }

            .select2-container.select2-container--open .select2-selection--single {
                background-color: #fefeff;
                border-color: #95a0f4;
            }

            .select2-results__option {
                padding: 10px;
            }

            .select2-search--dropdown .select2-search__field {
                padding: 7px;
            }

            .select2-container--default .select2-selection--single .select2-selection__rendered {
                min-height: 42px;
                line-height: 42px;
                padding-left: 20px;
                padding-right: 20px;
            }

            .select2-container--default .select2-selection--multiple .select2-selection__arrow, .select2-container--default .select2-selection--single .select2-selection__arrow {
                position: absolute;
                top: 1px;
                right: 1px;
                width: 40px;
                min-height: 42px;
            }

            .select2-container--default .select2-selection--multiple .select2-selection__choice {
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.03);
                color: #fff;
                padding-left: 10px;
                padding-right: 10px;
            }

            .select2-container--default .select2-selection--multiple .select2-selection__rendered {
                padding-left: 10px;
                padding-right: 10px;
            }

            .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
                margin-right: 5px;
                color: #fff;
            }

            .select2-container--default .select2-selection--multiple .select2-selection__choice,
            .select2-container--default .select2-results__option[aria-selected=true],
            .select2-container--default .select2-results__option--highlighted[aria-selected] {
                background-color: #6777ef;
                color: #fff;
            }

            .select2-results__option {
                padding-right: 10px 15px;
            }
        </style>
    </x-slot>

    <x-slot name="livewireJs">
        <script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
        <script>
            $('#id_supplier').select2();
        </script>
    </x-slot>

    <div class="card">
        <div class="card-header justify-content-between">
            <h4>Keranjang</h4>
            <a href="" class="text-danger" wire:click.prevent="clearRestock">Remove all</a>
        </div>
        <div class="card-body">
            @forelse(Cart::instance('restock')->content() as $obat)
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
                                   wire:change.prevent="updateQtyRestock('{{ $obat->rowId }}', $event.target.value, {{ $obat->id }})">
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
                <div class="col-9 font-weight-bold text-right">
                    Rp {{ @Cart::instance('restock')->total() }}
                </div>
            </div>
            <div class="row align-items-center mb-3">
                <div class="col-3">
                    <label for="id_supplier" class="col-form-label">Supplier</label>
                </div>
                <div class="col-9">
                    <select name="id_supplier" id="id_supplier" class="form-control">
                        <option value="" selected disabled>Pilih Supplier</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->nama }}</option>
                        @endforeach
                    </select>
                    {{--                    <input type="text" class="form-control @error('nama_pembeli') is-invalid @enderror"--}}
                    {{--                           placeholder="Nama pembeli" wire:model="nama_pembeli" id="nama_pembeli">--}}
                    @error('id_supplier') <small class="invalid-feedback">{{ $message }}</small> @enderror
                </div>
            </div>
            <button class="btn btn-primary btn-block"
                    {{ Cart::instance('restock')->count() <= 0 ? 'disabled' : '' }} wire:click.prevent="$emit('restockButtonClicked')">
                <i class="fa fa-check"></i> Restock
            </button>
        </div>
    </div>
</div>
