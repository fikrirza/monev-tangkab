@extends("layouts.base")

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

        <!-- ALERT NOTIFICATION -->
        @include('components.alert.error')
        <!-- /ALERT NOTIFICATION -->

        <!-- STATISTICS -->
        <div class="row">

            <div class="col-sm-6 col-md-3">
                @component('components.widgets.statistic')
                    @slot('icon')
                        fa fa-clone fa-3x
                    @endslot
                    @slot('value')
                        {{ count($program) }}
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
                        {{ count($kegiatan) }}
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
                        {{ count($item) }}
                    @endslot
                    

                    item kegiatan
                @endcomponent
            </div>

            <div class="col-sm-6 col-md-3">
                @component('components.widgets.statistic')
                    @slot('color')
                        orange
                    @endslot
                    @slot('icon')
                        fa fa-info-circle fa-3x
                    @endslot
                    @slot('value')
                        {{ count($indikator) }}
                    @endslot
                    

                    indikator
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
                                    <th class="text-center" colspan="2">Realisasi</th>
                                </tr>
                                <tr>
                                    <th class="text-center">Anggaran</th>
                                    <th class="text-center">Fisik</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @for ($i = 0; $i < 4; $i++)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>
                                            <span class="text-success">
                                                {{ number_format(Auth::user()->skpd->capaian[$i], 1, ".", ".") }}%
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-success">
                                                0%
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
                        Rp.{{ number_format(Auth::user()->skpd->anggaran, 2, ".", ".") }}
                        <!-- Rp.1.176.302.017.342,00 -->
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
        var graphData = [
            ['Realisasi Keuangan',    
                @foreach(Auth::user()->skpd->capaian as $value)
                    {{ number_format($value, 1, ".", ".") }},
                @endforeach
            ],
            ['Realisasi Fisik',    
                @foreach(Auth::user()->skpd->capaian as $value)
                    {{ 0 }},
                @endforeach
            ],
        ];
    </script>

    <script type="text/javascript" src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
@endsection