<x-stisla-layout>
    <x-slot name="title">
        Home
    </x-slot>

    <div class="section-header">
        <h1>Home</h1>
    </div>

    <x-slot name="css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    </x-slot>

    <x-slot name="js">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
                integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#myTable').DataTable();

                $(document).on('click', '#getUser', function (e) {
                    e.preventDefault();

                    var url = $(this).data('url');

                    $('#dynamic-content').html(''); // leave it blank before ajax call
                    $('#modal-loader').show();      // load ajax loader

                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'html'
                    })
                        .done(function (data) {
                            console.log(data);
                            $('#dynamic-content').html('');
                            $('#dynamic-content').html(data); // load response
                            $('#modal-loader').hide();        // hide ajax loader
                        })
                        .fail(function () {
                            $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });
                });
            });
        </script>
    </x-slot>

    <div class="section-body ">
        <h2 class="section-title">
            {{ $at_reorder_point->count() > 0 ? $at_reorder_point->count() . " produk mencapai reorder point" : "Tidak ada produk dibawah reorder point" }}
        </h2>
        <div class="card">
            <div class="table-responsive">
                <table class="table mb-0 table-hover">
                    <thead class="thead-dark ">
                    <tr scope="row">
                        <th scope="col" class="w-auto"></th>
                        <th scope="col" class="w-auto">Nama Obat</th>
                        <th scope="col" class="w-auto">Stok Saat Ini</th>
                        <th scope="col" class="w-auto">Reorder Point</th>
                        <th scope="col" class="w-auto">Jumlah Kurang</th>
{{--                        <th scope="col" class="w-auto"></th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($at_reorder_point as $obat)
                        <tr scope="row">
                            <td class="w-25 py-2">
                                <img src="{{ asset($obat->image) }}" class="w-25 mx-auto d-block"
                                     alt="{{ $obat->name }}">
                            </td>
                            <td class="align-middle">
                                <div class="font-weight-bold">{{ $obat->name }}</div>
                            </td>
                            <td class="align-middle">{{ $obat->restocks->sum('qty') }} {{ $obat->type }}</td>
                            <td class="align-middle">{{ $obat->reorder_point }} {{ $obat->type }}</td>
                            <td class="align-middle">{{ $obat->reorder_point - $obat->restocks->sum('qty') }} {{ $obat->type }}</td>
{{--                            <td class="text-center align-middle">--}}
{{--                                <button data-toggle="modal" data-target="#view-modal" id="getUser"--}}
{{--                                        class="btn btn-primary" data-url="{{ route('dynamicModal', $obat)}}">--}}
{{--                                    <i class="fa fa-plus"></i> Tambah Stok--}}
{{--                                </button>--}}
{{--                            </td>--}}
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
