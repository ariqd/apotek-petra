<x-stisla-layout>
    <x-slot name="title">
        Riwayat Pesanan ke {{ $supplier->nama }}
    </x-slot>

    <div class="section-header">
        <h1>Riwayat Pesanan ke {{ $supplier->nama }}</h1>
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
                $('#myTable').DataTable({
                    "order": []
                });
            });
        </script>
    </x-slot>

    <div class="section-body">
        <div class="card card-body">
            <div class="table-responsive">
                <table class="table table-bordered mb-0" id="myTable">
                    <thead class="thead-dark">
                    <tr>
                        <th class="w-auto"></th>
                        <th scope="col" class="w-auto">Tanggal Pesanan</th>
                        <th scope="col" class="w-auto">Admin</th>
                        <th scope="col" class="w-auto">Qty</th>
                        <th scope="col" class="w-auto">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($supplier->restocks as $restock)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $restock->created_at->translatedFormat('l, jS F Y g:i') }}</td>
                            <td>{{ $restock->user->name }}</td>
                            <td>{{ $restock->count }}</td>
                            <td>Rp {{ number_format($restock->total, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="4">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Obat</th>
                                        <th>Kadaluarsa</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                    </tr>
                                    </thead>
                                    @foreach ($restock->items as $item)
                                        <tr>
                                            <td class="w-25 p-2">
                                                <img src="{{ asset($item->image) }}" class="w-25 mx-auto d-block"
                                                     alt="{{ $item->name }}">
                                            </td>
                                            <td class="align-middle">
                                                <div class="font-weight-bold">{{ $item->name }}</div>
                                                <div>Harga beli:
                                                    Rp {{ number_format($item->harga_beli, 0, ',', '.') }}</div>
                                            </td>
                                            <td class="align-middle">{{ $item->expiry_date }}</td>
                                            <td class="align-middle">{{ $item->qty }} {{ $item->obat->type }}</td>
                                            <td class="align-middle">
                                                Rp {{ number_format($item->harga_beli * $item->qty, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                    @endforeach
                    <tbody>
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
