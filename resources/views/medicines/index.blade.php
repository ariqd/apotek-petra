<x-stisla-layout>
    <x-slot name="title">
        Obat
    </x-slot>

    <x-slot name="css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="{{ asset('assets/modules/jquery-selectric/selectric.css') }}">
    </x-slot>

    <x-slot name="js">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
                integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
        <script src="{{ asset('assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
        <script>
            $(document).ready(function () {
                $('#myTable').DataTable({
                    "order": []
                });
                $('.selectric').selectric();

                $('#kategori').on('change', function () {
                    document.forms['kategori'].submit();
                });

                $(document).on('click', '#getUser', function (e) {
                    e.preventDefault();

                    var url = $(this).data('url');

                    $('#dynamic-content').html(''); // leave it blank before ajax call
                    $('#loading').show();      // load ajax loader

                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'html'
                    })
                        .done(function (data) {
                            console.log(data);
                            $('#dynamic-content').html('');
                            $('#dynamic-content').html(data); // load response
                            $('#loading').hide();        // hide ajax loader
                        })
                        .fail(function () {
                            $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#loading').hide();
                        });
                });
            });
        </script>
    </x-slot>

    <div class="section-header d-flex justify-content-between align-items-center">
        <div>
            <h1>Obat</h1>
            @if(Auth::user()->role == 'Pemilik')
                <a href="{{ route('obat.create') }}" class="btn btn-primary btn-sm ml-3">
                    <i class="fas fa-plus"></i> Tambah Obat
                </a>
            @endif
        </div>
        <div>
            <form action="{{ route('obat.index') }}" method="GET" name="kategori">
                <select name="kategori" id="kategori" class="form-control selectric">
                    <option {{ Request::get('kategori') == "all" ? 'selected' : '' }} value="all">Semua Kategori
                    </option>
                    <option {{ Request::get('kategori') == "obat bebas" ? 'selected' : '' }} value="obat bebas">
                        Obat bebas
                    </option>
                    <option
                        {{ Request::get('kategori') == "obat bebas terbatas" ? 'selected' : '' }} value="obat bebas terbatas">
                        Obat bebas terbatas
                    </option>
                    <option {{ Request::get('kategori') == "obat keras" ? 'selected' : '' }} value="obat keras">
                        Obat keras
                    </option>
                    <option
                        {{ Request::get('kategori') == "obat wajib apotek" ? 'selected' : '' }} value="obat wajib apotek">
                        Obat wajib apotek
                    </option>
                    <option
                        {{ Request::get('kategori') == "golongan obat narkotika" ? 'selected' : '' }} value="golongan obat narkotika">
                        Golongan obat narkotika
                    </option>
                    <option
                        {{ Request::get('kategori') == "obat psikotropika" ? 'selected' : '' }} value="obat psikotropika">
                        Obat psikotropika
                    </option>
                    <option {{ Request::get('kategori') == "obat herbal" ? 'selected' : '' }} value="obat herbal">
                        Obat herbal
                    </option>
                </select>
            </form>
        </div>
    </div>

    <div class="section-body">
        <div class="card card-body">
            <div class="table-responsive">
                <table class="table mb-0 table-hover " id="myTable">
                    <thead class="thead-dark">
                    <tr scope="row">
                        <th scope="col" class="w-auto"></th>
                        <th scope="col" class="w-auto">Nama Obat</th>
                        <th scope="col" class="w-auto">Kategori</th>
                        <th scope="col" class="w-auto">Jenis</th>
                        <th scope="col" class="w-auto">Stok Saat Ini</th>
                        <th scope="col" class="w-auto">Reorder Point</th>
                        <th scope="col" class="w-auto">Rak</th>
                        @if(Auth::user()->role == 'Pemilik')
                            <th scope="col" class="w-auto"></th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($medicines as $obat)
                        <tr scope="row"
                            style="background-color: {{ $obat->restocks->sum('qty') <= $obat->reorder_point ? '#ffebee' : '' }}">
                            <td class="w-25">
                                <img src="{{ asset($obat->image) }}" class="w-25 mx-auto d-block"
                                     alt="{{ $obat->name }}">
                            </td>
                            <td class="align-middle">
                                <div class="font-weight-bold">{{ $obat->name }}</div>
                                <div>Harga jual: Rp {{ number_format($obat->price, 0, ',', '.') }}</div>
{{--                                <div>Harga beli: Rp {{ number_format($obat->harga_beli, 0, ',', '.') }}</div>--}}
                            </td>
                            <td class="align-middle">{{ ucwords($obat->kategori) }}</td>
                            <td class="align-middle">{{ $obat->type }}</td>
                            <td class="align-middle">{{ $obat->restocks->sum('qty') }} pcs</td>
                            <td class="align-middle">{{ $obat->reorder_point }} pcs</td>
                            <td class="align-middle">{{ $obat->rak }}</td>
                            @if(Auth::user()->role == 'Pemilik')
                                <td class="text-center align-middle">
                                    <a class="btn btn-sm btn-primary" href="{{ route('obat.show', $obat->id)}}">
                                        Detail
                                    </a>
                                    <a href="{{ route('obat.edit', $obat) }}" class="btn btn-sm btn-light ml-3">
                                        Edit
                                    </a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-slot name="modal">
        <div class="modal fade" id="view-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div id="dynamic-content"></div>
            </div>
        </div>
    </x-slot>

</x-stisla-layout>
