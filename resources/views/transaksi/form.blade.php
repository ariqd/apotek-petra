<x-stisla-layout>
    <x-slot name="title">
        Transaksi Baru
    </x-slot>

    <x-slot name="js">
        <script>
            $(document).ready(function (e) {
                Livewire.on('checkoutButtonClicked', () => {
                    swal({
                        title: "Checkout pesanan ini?",
                        text: "Stok akan otomatis dikurangi berdasarkan jumlah pesanan",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                        .then((willDelete) => {
                            if (willDelete) {
                                // swal("Poof! Your imaginary file has been deleted!", {
                                //     icon: "success",
                                // });
                                Livewire.emit('checkout')
                            }
                        });
                })
            });

        </script>
    </x-slot>

    <div class="section-header">
        <h1> Transaksi Baru</h1>
    </div>

    <div class="row">
        <div class="col-md-8">
            <livewire:cari-obat/>
        </div>
        <div class="col-md-4">
            <livewire:transaksi/>
        </div>
    </div>

</x-stisla-layout>
