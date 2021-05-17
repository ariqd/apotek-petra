<x-stisla-layout>
    <x-slot name="title">
        Kriteria
    </x-slot>

    <div class="section-header">
        <h1>Kriteria</h1>
        <a href="#" class="btn btn-primary btn-sm ml-3">
            <i class="fas fa-plus"></i> Tambah Kriteria
        </a>
    </div>

    <div class="section-body">
        <div class="card">

            <div class="table-responsive">
                <table class="table mb-0 table-hover">
                    <thead class="thead-dark ">
                        <tr scope="row">
                            <th scope="col" class="w-auto"></th>
                            <th scope="col" class="w-auto">Nama Kriteria</th>
                            <th scope="col" class="w-auto">Bobot</th>
                            <th scope="col" class="w-auto">Jenis</th>
                            <th scope="col" class="w-auto"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr scope="row">
                            <td>
                                1
                            </td>
                            <td class="font-weight-bold">Lama pengiriman obat</td>
                            <td>20%</td>
                            <td>Cost</td>
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
                            <td>2</td>
                            <td class="font-weight-bold">Ketersediaan obat</td>
                            <td>20%</td>
                            <td>Benefit</td>
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
                            <td>3</td>
                            <td class="font-weight-bold">Harga obat</td>
                            <td>25%</td>
                            <td>Cost</td>
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
