<x-stisla-layout>
    <x-slot name="title">
        Detail Restock {{ $obat->name }}
    </x-slot>

    <div class="section-header">
        <h1>Detail Restock {{ $obat->name }}</h1>
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
            });
        </script>
    </x-slot>

    <div class="section-body">
        <div class="card card-body">
            <div class="table-responsive">
                <table class="table mb-0 table-hover " id="myTable">
                    <thead class="thead-dark">
                    <tr scope="row">
                        <th scope="col" class="w-auto">Tanggal Restock</th>
                        <th scope="col" class="w-auto">Tanggal Kadaluarsa</th>
                        <th scope="col" class="w-auto">Qty</th>
                        <th scope="col" class="w-auto">Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($details as $item)
                        <tr scope="row">
                            <td class="align-middle">{{ $item->created_at->translatedFormat('l, jS F Y g:i') }}</td>
                            <td class="align-middle">{{ $item->expiry_date }}</td>
                            <td class="align-middle">{{ $item->qty }} {{ $item->obat->type }}</td>
                            <td class="align-middle">Rp {{ number_format($item->harga_beli * $item->qty, 0, ',', '.') }}</td>
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
