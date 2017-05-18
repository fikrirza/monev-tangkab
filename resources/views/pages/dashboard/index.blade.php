@extends("layouts.base")

{{-- Lihat DashboardController untuk melihat data mock --}}

@section('content')
    @component('components.header')
        @slot('title')
            E-Monev Pemkab Tanggerang
        @endslot

        @slot('description')
            One Team, One Spirit, One Goal, Tangerang GEMILANG
        @endslot

        @slot('breadcrumb')
        @endslot
    @endcomponent

    <!-- CONTENT -->
    <div class="content">

        <!-- STATISTICS -->
        <div class="row">

            <div class="col-sm-6 col-md-3">
                @component('components.widgets.statistic')
                    @slot('icon')
                        fa fa-clone fa-3x
                    @endslot
                    @slot('value')
                        528
                    @endslot
                    

                    total program
                @endcomponent
            </div>

            <div class="col-sm-6 col-md-3">
                @component('components.widgets.statistic')
                    @slot('color')
                        violet
                    @endslot
                    @slot('icon')
                        fa fa-calendar fa-3x
                    @endslot
                    @slot('value')
                        1842
                    @endslot
                    

                    kegiatan
                @endcomponent
            </div>

            <div class="col-sm-6 col-md-3">
                @component('components.widgets.statistic')
                    @slot('color')
                        indigo
                    @endslot
                    @slot('icon')
                        fa fa-tasks fa-3x
                    @endslot
                    @slot('value')
                        1936
                    @endslot
                    

                    sub kegiatan
                @endcomponent
            </div>

            <div class="col-sm-6 col-md-3">
                @component('components.widgets.statistic')
                    @slot('color')
                        orange
                    @endslot
                    @slot('icon')
                        fa fa-cubes fa-3x
                    @endslot
                    @slot('value')
                        14.372
                    @endslot
                    

                    item kegiatan
                @endcomponent
            </div>


        </div>
        <!-- END STATISTICS -->

        <div class="row">
            <!-- REALIZATION GRAPH -->
            <div class="col-md-7 col-sm-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h6 class="panel-title text-semibold">Realisasi Fisik dan Keuangan</h6>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="chart-container">
                            <div class="chart" id="graph"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END REALIZATION GRAPH -->

            <!-- REALIZATION TABLE -->
            <div class="col-md-5 col-sm-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h6 class="panel-title text-semibold">Tabel Realisasi</h6>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body" style="margin-bottom:18px;">
                        <table class="table table-bordered">
                            <thead >
                                <tr>
                                    <th class="text-center" rowspan="2">Triwulan</th>
                                    <th class="text-center" colspan="2">Keuangan</th>
                                    <th class="text-center" colspan="2">Fisik</th>
                                </tr>
                                <tr>
                                    <th class="text-center">Target</th>
                                    <th class="text-center">Realisasi</th>
                                    <th class="text-center">Target</th>
                                    <th class="text-center">Realisasi</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @for ($i = 0; $i < 4; $i++)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>
                                            {{ $target['financial'][$i] }}%
                                        </td>
                                        <td>
                                            <span class="text-{{ $realization['financial'][$i] >= $target['financial'][$i] ? 'success' : 'danger' }}">
                                                {{ $realization['financial'][$i] }}%
                                            </span>
                                        </td>
                                        <td>
                                            {{ $target['physical'][$i] }}%
                                        </td>
                                        <td>
                                            <span class="text-{{ $realization['physical'][$i] >= $target['physical'][$i] ? 'success' : 'danger' }}">
                                                {{ $realization['physical'][$i] }}%
                                            </span>
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- BUDGET STATISTIC -->
                @component('components.widgets.statistic')
                    
                    @slot('color')
                        slate
                    @endslot
                    @slot('icon')
                        fa fa-archive fa-3x
                    @endslot
                    @slot('value')
                        Rp.1.176.302.017.342,00
                    @endslot
                    

                    Anggaran Daerah
                @endcomponent
                <!-- END BUDGET STATISTIC -->

            </div>
            <!-- END REALIZATION TABLE -->

        </div>

    </div>
    <!-- END CONTENT -->
@endsection

@section('scripts')
    @parent

    <!-- Graph Data -->
    <script type="text/javascript">
        // Sementara untuk mockup, data yang digunakan adalah data mocking / dummy.
        // HACK: Dibagi 100 karena masalah formatting untuk tanda persentase (%)
        var graphData = [
            ['Target Keuangan',    
                @foreach($target['financial'] as $value)
                    {{ $value / 100 }},
                @endforeach
            ],
            ['Target Fisik',    
                @foreach($target['physical'] as $value)
                    {{ $value / 100 }},
                @endforeach
            ],

            ['Realisasi Keuangan',    
                @foreach($realization['financial'] as $value)
                    {{ $value / 100 }},
                @endforeach
            ],
            ['Realisasi Fisik',    
                @foreach($realization['physical'] as $value)
                    {{ $value / 100 }},
                @endforeach
            ],
        ];
    </script>

    <script type="text/javascript" src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
@endsection