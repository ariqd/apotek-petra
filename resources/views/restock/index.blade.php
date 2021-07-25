<x-stisla-layout>
    <x-slot name="title">
        Restock
    </x-slot>

    <div class="section-header">
        <h1>Restock</h1>
        <a href="{{ route('restock.create') }}" class="btn btn-primary btn-sm ml-3">
            <i class="fas fa-plus"></i> Pesan ke Supplier
        </a>
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
                <table class="table mb-0 table-hover" id="myTable">
                    <thead class="thead-dark">
                    <tr scope="row">
                        <th scope="col" class="w-auto">Tanggal</th>
                        <th scope="col" class="w-auto">Nama Pembeli</th>
                        <th scope="col" class="w-auto">Jumlah Obat</th>
                        <th scope="col" class="w-auto">Total</th>
                        <th scope="col" class="w-auto"></th>
                    </tr>
                    </thead>
                    <tbody>
{{--                    @foreach($transactions as $transaction)--}}
{{--                        <tr scope="row">--}}
{{--                            <td>{{ $transaction->created_at->translatedFormat('l, jS F Y g:i') }}</td>--}}
{{--                            <td class="font-weight-bold">{{ $transaction->nama_pembeli }}</td>--}}
{{--                            <td>{{ $transaction->count }}</td>--}}
{{--                            <td>Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>--}}
{{--                            <td class="text-center">--}}
{{--                                <a href="{{ route('transaksi.show', $transaction->id) }}" class="btn btn-primary">--}}
{{--                                    Detail Transaksi--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-stisla-layout>
