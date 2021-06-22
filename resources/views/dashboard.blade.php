<x-stisla-layout>
    <x-slot name="title">
        Dashboard
    </x-slot>

    <x-slot name="js">
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        <script>
            // @formatter:off
            function formatNumber(num) {
                return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
            }

            document.addEventListener("DOMContentLoaded", function () {
                window.ApexCharts && (new ApexCharts(document.getElementById('chart-bestseller'), {
                    chart: {
                        type: "bar",
                        fontFamily: 'inherit',
                        height: 240,
                        parentHeightOffset: 0,
                        toolbar: {
                            show: false,
                        },
                        animations: {
                            enabled: false
                        },
                    },
                    fill: {
                        opacity: 1,
                    },
                    stroke: {
                        width: 2,
                        lineCap: "round",
                        curve: "straight",
                    },
                    series: [{
                        name: "Terjual pcs",
                        data: [
                            {{ $bestSeller->values()[0] }},
                            {{ $bestSeller->values()[1] }},
                            {{ $bestSeller->values()[2] }},
                            {{ $bestSeller->values()[3] }},
                            {{ $bestSeller->values()[4] ?? 0 }},
                        ],
                    }],
                    grid: {
                        padding: {
                            top: -20,
                            right: 0,
                            left: -4,
                            bottom: -4
                        },
                        strokeDashArray: 4,
                    },
                    xaxis: {
                        labels: {
                            padding: 0,
                        },
                        tooltip: {
                            enabled: true
                        },
                        categories: [
                            "{{ $bestSeller->keys()[0] }}",
                            "{{ $bestSeller->keys()[1] }}",
                            "{{ $bestSeller->keys()[2] }}",
                            "{{ $bestSeller->keys()[3] }}",
                            "{{ $bestSeller->keys()[4] ?? '' }}",
                        ],
                    },
                    yaxis: {
                        labels: {
                            padding: 4
                        },
                    },
                    chartOptions: {
                        plotOptions: {
                            bar: {
                                columnWidth: '1%',
                                barHeight: '70%',
                            }
                        }
                    },
                    colors: ["#6777EF"],
                    legend: {
                        show: true,
                    },
                })).render();

                var options = {
                    series: [{
                        name: "Obat",
                        data: [
                            {{ $penjualan[0] }},
                            {{ $penjualan[1] }},
                            {{ $penjualan[2] }},
                            {{ $penjualan[3] }},
                            {{ $penjualan[4] }},
                            {{ $penjualan[5] }},
                            {{ $penjualan[6] }},
                            {{ $penjualan[7] }},
                            {{ $penjualan[8] }},
                            {{ $penjualan[9] }},
                            {{ $penjualan[10] }},
                            {{ $penjualan[11] }},
                        ]
                    }],
                    chart: {
                        height: 350,
                        type: 'line',
                        zoom: {
                            enabled: false
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: function (value) {
                            return "Rp " + formatNumber(value);
                        }
                    },
                    stroke: {
                        curve: 'straight'
                    },
                    title: {
                        text: 'Grafik Penjualan Per Bulan',
                        align: 'center'
                    },
                    grid: {
                        row: {
                            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                            opacity: 0.5
                        },
                    },
                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    },
                    colors: ["#6777EF"],
                    yaxis: {
                        labels: {
                            formatter: function (value) {
                                return "Rp " + formatNumber(value);
                            }
                        },
                    },
                };

                var chart = new ApexCharts(document.querySelector("#line-chart"), options);
                chart.render();
            });
            // @formatter:on
        </script>
    </x-slot>

    <div class="section-header">
        <h1>Dashboard</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card card-body">
                    <div id="line-chart"></div>
                </div>
            </div>
            <div class="col-6">
                <div class="card card-body">
                    <h5 class="text-center mb-3">Riwayat Transaksi Terakhir</h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Obat</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($riwayatTransaksi as $obat)
                                <tr>
                                    <td>{{ $obat->name }}</td>
                                    <td>{{ $obat->qty }} pcs</td>
                                    <td>Rp {{ number_format($obat->price * $obat->qty, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card card-body">
                    <h5 class="text-center">Obat Best Seller</h5>
                    <div id="chart-bestseller"></div>
                </div>
            </div>
        </div>
    </div>
</x-stisla-layout>
