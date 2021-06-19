<x-stisla-layout>
    <x-slot name="title">
        Detail Transaksi {{ $transaction->nama_pembeli }} pada hari {{ $transaction->created_at->translatedFormat('l, jS F Y g:i') }}
    </x-slot>

    <div class="section-header">
        <h1>Detail Transaksi {{ $transaction->nama_pembeli }} pada hari {{ $transaction->created_at->translatedFormat('l, jS F Y g:i') }}</h1>
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
                        <th scope="col" class="w-auto"></th>
                        <th scope="col" class="w-auto">Nama Obat</th>
                        <th scope="col" class="w-auto">Qty</th>
                        <th scope="col" class="w-auto">Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($transaction->items as $item)
                        <tr scope="row">
                            <td class="w-25 p-2">
                                <img src="{{ asset($item->image) }}" class="w-25 mx-auto d-block"
                                     alt="{{ $item->name }}">
                            </td>
                            <td class="align-middle">
                                <div class="font-weight-bold">{{ $item->name }}</div>
                                <div>Rp {{ number_format($item->obat->price, 0, ',', '.') }}</div>
                            </td>
                            <td class="align-middle">{{ $item->qty }} {{ $item->obat->type }}</td>
                            <td class="align-middle">Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="3">
                            <div class="text-right">Total</div>
                        </td>
                        <td class="font-weight-bold">
                            Rp {{ number_format($transaction->total, 0, ',', '.') }}
                        </td>
                    </tr>
                    </tfoot>
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
