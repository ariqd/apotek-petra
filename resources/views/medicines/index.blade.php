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

    <div class="section-body">
        {{-- <h2 class="section-title">3 produk mencapai limit stok</h2> --}}
        {{-- <p class="section-lead">This page is just an example for you to create your own page.</p> --}}
        <div class="card">

            <div class="table-responsive">
                <table class="table mb-0 table-hover">
                    <thead class="thead-dark">
                        <tr scope="row">
                            <th scope="col" class="w-auto"></th>
                            <th scope="col" class="w-auto">Nama Obat</th>
                            <th scope="col" class="w-auto">Stok Saat Ini</th>
                            <th scope="col" class="w-auto">Limit Stok</th>
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
                                <a href="#" class="btn btn-primary">
                                    Edit
                                </a>
                                <a href="#" class="btn btn-light ml-3">
                                    Delete
                                </a>
                            </td>
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
                                <a href="#" class="btn btn-primary">
                                    Edit
                                </a>
                                <a href="#" class="btn btn-light ml-3">
                                    Delete
                                </a>
                            </td>
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
                                <a href="#" class="btn btn-primary">
                                    Edit
                                </a>
                                <a href="#" class="btn btn-light ml-3">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    </tbody>
                    {{-- <tfoot>
                        <tr scope="row">
                            <td colspan="4" class="text-end">
                                <strong>Total:</strong>
                            </td>
                            <td>Rp 6.000.000</td>
                            <td class="d-grid">
                                <a href="" class="btn btn-primary">Checkout</a>
                            </td>
                        </tr>
                    </tfoot> --}}
                </table>
            </div>
            {{-- <div class="card-header">
                <h4>Example Card</h4>
            </div>
            <div class="card-body">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div> --}}
        </div>
    </div>
</x-stisla-layout>
