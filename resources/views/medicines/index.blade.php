<x-stisla-layout>
    <x-slot name="title">
        Obat
    </x-slot>

    <div class="section-header">
        <h1>Obat</h1>
        <a href="{{ route('obat.create') }}" class="btn btn-primary btn-sm ml-3">
            <i class="fas fa-plus"></i> Tambah Obat
        </a>
    </div>

    <x-slot name="js">
        <script>
            $(document).ready(function(){
                $(document).on('click', '#getUser', function(e){
                    e.preventDefault();

                    var url = $(this).data('url');

                    $('#dynamic-content').html(''); // leave it blank before ajax call
                    $('#modal-loader').show();      // load ajax loader

                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'html'
                    })
                    .done(function(data){
                        console.log(data);
                        $('#dynamic-content').html('');
                        $('#dynamic-content').html(data); // load response
                        $('#modal-loader').hide();        // hide ajax loader
                    })
                    .fail(function(){
                        $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                        $('#modal-loader').hide();
                    });
                });
            });
        </script>
    </x-slot>

    <div class="section-body">
        <div class="card">
            <div class="table-responsive">
                <table class="table mb-0 table-hover">
                    <thead class="thead-dark">
                        <tr scope="row">
                            <th scope="col" class="w-auto"></th>
                            <th scope="col" class="w-auto">Nama Obat</th>
                            <th scope="col" class="w-auto">Stok Saat Ini</th>
                            <th scope="col" class="w-auto">Reorder Point</th>
                            <th scope="col" class="w-auto"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr scope="row">
                            <td class="w-25 p-2">
                                <img src="https://cms.sehatq.com/cdn-cgi/image/f=auto,width=589,fit=pad,background=white,quality=100/public/img/drugbrand_img/stimuno-sirup-60-ml-01-1571106213.jpg"
                                    class="w-50 mx-auto d-block" alt="singleminded">
                            </td>
                            <td class="font-weight-bold">Stimuno</td>
                            <td>5</td>
                            <td>10</td>
                            <td class="text-center">
                                <button data-toggle="modal" data-target="#view-modal" id="getUser"
                                    class="btn btn-primary" data-url="{{ route('dynamicModal',['id'=>1])}}">
                                    <i class="fa fa-plus"></i> Tambah Stok
                                </button>
                                <a href="{{ url('obat/1/edit') }}" class="btn btn-light ml-3">
                                    Edit
                                </a>
                            </td>
                        </tr>
                        <tr scope="row">
                            <td class="w-25 p-2">
                                <img src="https://cms.sehatq.com/cdn-cgi/image/f=auto,width=589,fit=pad,background=white,quality=100/public/img/drugbrand_img/stimuno-sirup-60-ml-01-1571106213.jpg"
                                    class="w-50 mx-auto d-block" alt="singleminded">
                            </td>
                            <td class="font-weight-bold">CDR Vitamin C</td>
                            <td>5</td>
                            <td>10</td>
                            <td class="text-center">
                                <button data-toggle="modal" data-target="#view-modal" id="getUser"
                                    class="btn btn-primary" data-url="{{ route('dynamicModal',['id'=>2])}}">
                                    <i class="fa fa-plus"></i> Tambah Stok
                                </button>
                                <a href="{{ url('obat/2/edit') }}" class="btn btn-light ml-3">
                                    Edit
                                </a>
                            </td>
                        </tr>
                        <tr scope="row">
                            <td class="w-25 p-2">
                                <img src="https://cms.sehatq.com/cdn-cgi/image/f=auto,width=589,fit=pad,background=white,quality=100/public/img/drugbrand_img/stimuno-sirup-60-ml-01-1571106213.jpg"
                                    class="w-50 mx-auto d-block" alt="singleminded">
                            </td>
                            <td class="font-weight-bold">Mylanta</td>
                            <td>5</td>
                            <td>10</td>
                            <td class="text-center">
                                <button data-toggle="modal" data-target="#view-modal" id="getUser"
                                    class="btn btn-primary" data-url="{{ route('dynamicModal',['id'=>3])}}">
                                    <i class="fa fa-plus"></i> Tambah Stok
                                </button>
                                <a href="{{ url('obat/3/edit') }}" class="btn btn-light ml-3">
                                    Edit
                                </a>
                            </td>
                        </tr>
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
