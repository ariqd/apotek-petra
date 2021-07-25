<x-stisla-layout>
    <x-slot name="title">
        {{ $title }}
    </x-slot>

    <x-slot name="js">
        <script>
            $(document).ready(function (e) {
                Livewire.on('showLoading', () => {
                    $('#loading').show();
                })

                Livewire.on('searching', () => {
                    // $('#loading').show();
                    // Livewire.emit('updatedSearch')
                })

                Livewire.on('addToCartButtonClick', $id => {
                    Livewire.emit('cartButton', $id)
                })

                Livewire.on('hideLoading', () => {
                    $('#loading').hide();
                })

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
                                Livewire.emit('checkout')
                            }
                        });
                })

                Livewire.on('restockButtonClicked', () => {
                    swal({
                        title: "Ajukan pemesanan ke Supplier ini?",
                        text: "Stok akan otomatis ditambah berdasarkan jumlah pesanan",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                        .then((willDelete) => {
                            if (willDelete) {
                                Livewire.emit('doRestock')
                            }
                        });
                })
            });

        </script>
    </x-slot>

    <div class="section-header">
        <h1>{{ $title }}</h1>
    </div>

    <div class="row">
        <div class="col-md-8">
            <livewire:cari-obat :isTransaksi="$isTransaksi"/>
        </div>
        <div class="col-md-4">
            @if($isTransaksi)
                <livewire:transaksi/>
            @else
                <livewire:restock/>
            @endif
        </div>
    </div>

</x-stisla-layout>
