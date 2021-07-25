<x-stisla-layout>
    <x-slot name="title">
        {{ $title }}
    </x-slot>

    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
        <style>
            .select2-container--default .select2-search--dropdown .select2-search__field:focus {
                outline: none;
                box-shadow: none;
            }

            .select2-container .select2-selection--multiple, .select2-container .select2-selection--single {
                box-sizing: border-box;
                cursor: pointer;
                display: block;
                min-height: 42px;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                -webkit-user-select: none;
                outline: none;
                background-color: #fdfdff;
                border-color: #e4e6fc;
            }

            .select2-dropdown {
                border-color: #e4e6fc !important;
            }

            .select2-container.select2-container--open .select2-selection--multiple {
                background-color: #fefeff;
                border-color: #95a0f4;
            }

            .select2-container.select2-container--focus .select2-selection--multiple, .select2-container.select2-container--focus .select2-selection--single {
                background-color: #fefeff;
                border-color: #95a0f4;
            }

            .select2-container.select2-container--open .select2-selection--single {
                background-color: #fefeff;
                border-color: #95a0f4;
            }

            .select2-results__option {
                padding: 10px;
            }

            .select2-search--dropdown .select2-search__field {
                padding: 7px;
            }

            .select2-container--default .select2-selection--single .select2-selection__rendered {
                min-height: 42px;
                line-height: 42px;
                padding-left: 20px;
                padding-right: 20px;
            }

            .select2-container--default .select2-selection--multiple .select2-selection__arrow, .select2-container--default .select2-selection--single .select2-selection__arrow {
                position: absolute;
                top: 1px;
                right: 1px;
                width: 40px;
                min-height: 42px;
            }

            .select2-container--default .select2-selection--multiple .select2-selection__choice {
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.03);
                color: #fff;
                padding-left: 10px;
                padding-right: 10px;
            }

            .select2-container--default .select2-selection--multiple .select2-selection__rendered {
                padding-left: 10px;
                padding-right: 10px;
            }

            .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
                margin-right: 5px;
                color: #fff;
            }

            .select2-container--default .select2-selection--multiple .select2-selection__choice,
            .select2-container--default .select2-results__option[aria-selected=true],
            .select2-container--default .select2-results__option--highlighted[aria-selected] {
                background-color: #6777ef;
                color: #fff;
            }

            .select2-results__option {
                padding-right: 10px 15px;
            }
        </style>
    </x-slot>

    <x-slot name="js">
        <script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>

        <script>
            $(document).ready(function (e) {
                // $('.select2').select2();

                window.initSelectCategory = () => {
                    $('#supplierId').select2();
                }

                initSelectCategory();

                $('#supplierId').on('change', function (e) {
                    Livewire.emit('showLoading')
                    Livewire.emit('selectedCategory', e.target.value)
                });

                window.Livewire.on('select2', () => {
                    initSelectCategory();
                });

                Livewire.on('showLoading', () => {
                    $('#loading').show();
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
                                $('#loading').show();

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
        <div class="col-md-7">
            <livewire:cari-obat :isTransaksi="$isTransaksi"/>
        </div>
        <div class="col-md-5">
            @if($isTransaksi)
                <livewire:transaksi/>
            @else
                <livewire:restock/>
            @endif
        </div>
    </div>

</x-stisla-layout>
