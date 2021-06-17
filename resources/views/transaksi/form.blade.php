<x-stisla-layout>
    <x-slot name="title">
        Transaksi Baru
    </x-slot>

    {{-- <x-slot name="js">
        <script>
            $(document).ready(function (e) {
                $('#image').change(function(){
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-image-before-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

                });
            });

        </script>
    </x-slot> --}}

    <div class="section-header">
        <h1> Transaksi Baru</h1>
    </div>

    <div class="row">
        <div class="col-md-8">
            <livewire:cari-obat />
        </div>
        <div class="col-md-4">
            <livewire:transaksi />
        </div>
    </div>

</x-stisla-layout>
