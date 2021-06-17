<x-stisla-layout>
    <x-slot name="title">
        {{ @$edit ? 'Edit' : 'Tambah' }} Obat {{ @$edit ? @$obat->name : '' }}
    </x-slot>

    <x-slot name="js">
        <script>
            $(document).ready(function (e) {
                $('#image').change(function(){
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-image').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

                });
            });

        </script>
    </x-slot>

    <div class="section-header">
        <h1> {{ @$edit ? 'Edit' : 'Tambah' }} Obat {{ @$edit ? @$obat->name : '' }}</h1>
        <a href="{{ route('obat.index') }}" class="btn btn-light btn-sm ml-3">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <form action="{{ @$edit ? route('obat.update', $obat) : route('obat.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{ @$edit ? method_field('PUT') : '' }}
                    <div class="row">
                        <div class="col-4">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="preview-image-before-upload">
                                            {{@$edit ? 'Update Gambar' : 'Upload Gambar'}}
                                        </label>
                                        <input type="file" name="image" placeholder="Choose image" id="image"
                                            accept="image/*" class="form-control">
                                        @error('image')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 mb-2">
                                    @if (@$edit)
                                    <img id="preview-image" src="{{ asset(@$obat->image) }}" alt="{{ $obat->name }}"
                                        class="img-fluid">
                                    @else
                                    <img id="preview-image"
                                        src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                                        alt="preview image" class="img-fluid">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-group">
                                <label for="name">Nama Obat</label>
                                <input type="text" class="form-control" id="name" placeholder="Nama Obat" name="name"
                                    value="{{ @$edit ? @$obat->name : old('name')}}">
                            </div>
                            <div class="form-group">
                                <label for="type">Jenis Packaging Obat</label>
                                <select id="type" name="type" class="form-control" id="basicSelect">
                                    <option value="0" selected disabled>Pilih Jenis Packaging Obat</option>
                                    <option value="Box" @if (@$obat->type == 'Box') selected @endif>
                                        Box
                                    </option>
                                    <option value="Botol" @if (@$obat->type == 'Botol') selected @endif>Botol
                                    </option>
                                    <option value="Tube" @if (@$obat->type == 'Tube') selected @endif>Tube</option>
                                    <option value="Pot" @if (@$obat->type == 'Pot') selected @endif>Pot</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="price">Harga</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                    <input type="number" class="form-control" name="price" id="price"
                                        placeholder="Harga Obat" aria-label="Harga" aria-describedby="basic-addon1"
                                        value="{{ @$edit ? @$obat->price : old('price')}}">
                                </div>
                            </div>
                            @if (@!$edit)
                            <div class="form-group">
                                <label for="stock">Stok</label>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" name="stock" id="stock"
                                        placeholder="Jumlah Stok (dalam pcs)" aria-label="Harga"
                                        aria-describedby="basic-addon1"
                                        value="{{ @$edit ? @$obat->stock : old('stock') }}">
                                    <span class="input-group-text" id="basic-addon1">pcs</span>
                                </div>
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="reorder_point">Reorder Point</label>
                                <div class="input-group mb-1">
                                    <input type="number" class="form-control" name="reorder_point" id="reorder_point"
                                        placeholder="Obat harus dipesan ke supplier jika menyentuh angka... (dalam pcs)"
                                        aria-label="Harga" aria-describedby="basic-addon1"
                                        value="{{ @$edit ? @$obat->reorder_point : old('reorder_point') }}">
                                    <span class="input-group-text" id="basic-addon1">pcs</span>
                                </div>
                                <span class="text-muted">Obat harus dipesan ke supplier jika menyentuh angka ini.</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit"
                                class="btn btn-primary">{{ @$edit ? 'Finish Edit' : 'Simpan' }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-stisla-layout>
