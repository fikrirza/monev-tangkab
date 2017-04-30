@extends("layouts.base")

@section('content')
    @component('components.header')
        @slot('title')
            Anggaran
        @endslot

        @slot('description')
            Data anggaran yang sudah tercatat
        @endslot

        @slot('breadcrumb')
            <li class="active">
                Anggaran
            </li>
        @endslot
    @endcomponent

    <!-- CONTENT -->
    <div class="content">

        <!-- STATISTICS -->
        <div class="row">

            <div class="col-sm-6 col-md-4">
                @component('components.widgets.statistic')
                    @slot('icon')
                        fa fa-money fa-4x
                    @endslot
                    @slot('value')
                        Rp.1.176.277.757.342
                    @endslot

                    14.784 Paket
                    <h6>Anggaran Induk</h6>
                @endcomponent
            </div>

            <div class="col-sm-6 col-md-4">
                @component('components.widgets.statistic')
                    @slot('color')
                        violet
                    @endslot
                    @slot('icon')
                        fa fa-gg fa-4x
                    @endslot
                    @slot('value')
                        Rp.1.960.000
                    @endslot

                    1 Paket
                    <h6>Anggaran Lanjutan</h6>
                @endcomponent
            </div>

            <div class="col-sm-12 col-md-4">
                @component('components.widgets.statistic')
                    @slot('color')
                        indigo
                    @endslot
                    @slot('icon')
                        fa fa-exchange fa-3x
                    @endslot
                    @slot('value')
                        Rp.22.300.000
                    @endslot
                    
                    1 Paket
                    <h6>Anggaran Perubahan</h6>
                @endcomponent
            </div>

            <div class="col-sm-12 col-md-12">
                @component('components.widgets.statistic')
                    @slot('color')
                        success
                    @endslot
                    @slot('value')
                        <div class="text-center">
                            Rp.1.176.302.017.342
                        </div>
                    @endslot
                    
                    <h6 class="text-center">Total Anggaran</h6>
                @endcomponent
            </div>

        </div>
        <!-- END STATISTICS -->

        <div class="row">

            <!-- REALIZATION GRAPH -->
            <div class="col-md-7 col-sm-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h6 class="panel-title text-semibold">Komposisi Anggaran</h6>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="chart-heading text-center">
                            <h1>Belanja Langsung</h1>
                            <small>Satuan kerja perangkat daerah</small>
                        </div>
                        <div class="chart-container">
                            <div class="chart" id="graph"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END REALIZATION GRAPH -->

            <!-- SOURCE FUND TABLE -->
            <div class="col-md-5 col-sm-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h6 class="panel-title text-semibold">Sumber Dana</h6>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Pendapatan Asli Daerah</td>
                                    <td>427 Paket</td>
                                    <td class="text-right">
                                        <span class="text-default">Rp.25.365.568.100</span>
                                        <div class="text-muted text-size-small">
                                            2.16%
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dana Bagi Hasil</td>
                                    <td>6 Paket</td>
                                    <td class="text-right">
                                        <span class="text-default">Rp.317.250.000</span>
                                        <div class="text-muted text-size-small">
                                            0.03%
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dana Bagi Hasil</td>
                                    <td>13.741 Paket</td>
                                    <td class="text-right">
                                        <span class="text-default">Rp.1.002.472.864.581</span>
                                        <div class="text-muted text-size-small">
                                            85.22%
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dana Alokasi Khusus</td>
                                    <td>282 Paket</td>
                                    <td class="text-right">
                                        <span class="text-default">Rp.129.481.096.761</span>
                                        <div class="text-muted text-size-small">
                                            11.01%
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dana Kontijensi / Dekonsentrasi</td>
                                    <td>0 Paket</td>
                                    <td class="text-right">
                                        <span class="text-default">Rp.0</span>
                                        <div class="text-muted text-size-small">
                                            0%
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Lain - Lain Pendapatan Daerah Yang Sah</td>
                                    <td>0 Paket</td>
                                    <td class="text-right">
                                        <span class="text-default">Rp.0</span>
                                        <div class="text-muted text-size-small">
                                            0%
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Lainnya</td>
                                    <td>327 Paket</td>
                                    <td class="text-right">
                                        <span class="text-default">Rp.18.590.137.900</span>
                                        <div class="text-muted text-size-small">
                                            1.58%
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <!-- END SOURCE FUND TABLE -->

        </div>

        <div class="panel">
            <div class="panel-heading">
                <h6 class="panel-title text-semibold">Anggaran Satuan Kerja</h6>
            </div>
            <div class="table-responsive">
                <table class="table datatable" data-sort="2" data-actions="copy,csv,excel,pdf,print">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Sub Organisasi</th>
                            <th>Anggaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $record) 
                            <tr>
                                <td>{{ $record['id'] }}</td>
                                <td>{{ $record['name'] }}</td>
                                <td>Rp.{{ number_format($record['budget'], 2, '.', ',') }}</td>
                                <td>
                                    <a href="#" class="btn btn-raised btn-primary">
                                        Lihat Detil
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
    <!-- END CONTENT -->
@endsection

@section('scripts')
    @parent

    <!-- Graph Data -->
    <script type="text/javascript">
        var graphData = [
            @foreach($data as $record) 
                ['{{ $record['name'] }}', {{ $record['percentage'] }} ],
            @endforeach
        ];
    </script>

    <script type="text/javascript" src="{{ asset('assets/js/pages/budget.js') }}"></script>
@endsection