<x-stisla-layout>
    <x-slot name="title">
        Supplier
    </x-slot>

    <div class="section-header">
        <h1>Supplier</h1>
        <button data-toggle="modal" data-target="#view-modal" data-url="{{ route('supplier.create') }}"
                class="btn btn-primary btn-sm ml-3 link">
            <i class="fas fa-plus"></i> Tambah Supplier
        </button>
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

                $(document).on('click', '.link', function (e) {
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

    <div class="section-body">
        <div class="card">

            <div class="table-responsive">
                <table class="table mb-0 table-hover">
                    <thead class="thead-dark ">
                    <tr scope="row">
                        <th scope="col" class="w-auto"></th>
                        <th scope="col" class="w-auto">Nama Supplier</th>
                        <th scope="col" class="w-auto">Alamat</th>
                        <th scope="col" class="w-auto">Kota</th>
                        <th scope="col" class="w-auto">No. Telp</th>
{{--                        <th scope="col" class="w-auto">Jenis Obat</th>--}}
                        <th scope="col" class="w-auto"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($suppliers as $supplier)
                        <tr scope="row">
                            <td>{{ $loop->iteration }}</td>
                            <td class="font-weight-bold">{{ $supplier->nama }}</td>
                            <td>{{ $supplier->alamat }}</td>
                            <td>{{ $supplier->kota }}</td>
                            <td>{{ $supplier->no_telp }}</td>
{{--                            <td>{{ $supplier->jenis_obat }}</td>--}}
                            <td class="text-center">
                                <button data-toggle="modal" data-target="#view-modal"
                                        data-url="{{ route('supplier.edit', $supplier) }}"
                                        class="btn btn-primary btn-sm link">
                                    Edit
                                </button>
                            </td>
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
