@extends("layouts.base")

@section('content')
    @component('components.header')
        @slot('title')
            {{  $program['name'] }}
        @endslot

        @slot('description')
            {{ $program['description'] }}
        @endslot

        @slot('breadcrumb')
            <li>
                <a href="{{ url('program') }}">
                    Program
                </a>
            </li>
            <li>
                <a href="{{ url('program', $program['id']) }}">
                    {{ $program['name'] }}
                </a>
            </li>
            <li class="active">
                {{ $activity['name'] }}
            </li>
        @endslot
    @endcomponent

    <!-- CONTENT -->
    <div class="content">

        <!-- ACTIVITY DETAIL TABLE -->
        <div class="panel panel-white">
            <div class="panel-heading">
                <h6 class="panel-title text-semibold">{{ $activity['name'] }}</h6>
            </div>
            <div class="panel-body table-responsive">
                <table class="table table-bordered datatable" data-paging="false" data-show-info="false" data-searching="false" data-ordering="false">
                    <thead>
                        <tr>
                            <th rowspan="2">Indikator</th>
                            <th rowspan="2">Tolak Ukur</th>
                            <th rowspan="2">Target</th>
                            <th colspan="4" class="text-center">Realisasi</th>
                            <th rowspan="2" class="text-center">Aksi</th>
                        </tr>
                        <tr>
                            <td>I</td>
                            <td>II</td>
                            <td>III</td>
                            <td>IV</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Masukan</td>
                            <td>{{ $activity['input']['type'] }}</td>
                            <td class="text-semibold">
                                @if ($activity['input']['unitType'] == 'prefix')
                                    {{ $activity['input']['unit'] }}
                                @endif

                                {{ number_format($activity['input']['target'],2,",",".") }}

                                @if ($activity['input']['unitType'] == 'suffix')
                                    {{ $activity['input']['unit'] }}
                                @endif
                            </td>
                            <td colspan="5" class="text-center"> N / A </td>
                            @for ($i = 0; $i < 4; $i++)
                                <td style="display: none;"></td>
                            @endfor
                        </tr>
                        <tr>
                            <td>Keluaran</td>
                            <td>{{ $activity['output']['type'] }}</td>
                            <td class="text-semibold">
                                @if ($activity['output']['unitType'] == 'prefix')
                                    {{ $activity['output']['unit'] }}
                                @endif

                                {{ number_format($activity['output']['target'],0,",",".") }}

                                @if ($activity['output']['unitType'] == 'suffix')
                                    {{ $activity['output']['unit'] }}
                                @endif
                            </td>
                            @for ($i = 0; $i < 4; $i++)
                                <td>
                                    @if ($activity['output']['unitType'] == 'prefix')
                                        {{ $activity['output']['unit'] }}
                                    @endif

                                    {{ number_format($activity['output']['realization'][$i],0,",",".") }}

                                    @if ($activity['output']['unitType'] == 'suffix')
                                        {{ $activity['output']['unit'] }}
                                    @endif
                                </td>
                            @endfor
                            <td>
                                <a href="{{ url('kegiatan/' . $activity['id'] . '/ubah?type=output') }}" class="btn btn-raised btn-primary">
                                    Ubah
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>Hasil</td>
                            <td>{{ $activity['result']['type'] }}</td>
                            <td class="text-semibold">
                                @if ($activity['result']['unitType'] == 'prefix')
                                    {{ $activity['result']['unit'] }}
                                @endif

                                {{ number_format($activity['result']['target'],0,",",".") }}

                                @if ($activity['result']['unitType'] == 'suffix')
                                    {{ $activity['result']['unit'] }}
                                @endif
                            </td>
                            @for ($i = 0; $i < 4; $i++)
                                <td>
                                    @if ($activity['result']['unitType'] == 'prefix')
                                        {{ $activity['result']['unit'] }}
                                    @endif

                                    {{ number_format($activity['result']['realization'][$i],0,",",".") }}

                                    @if ($activity['result']['unitType'] == 'suffix')
                                        {{ $activity['result']['unit'] }}
                                    @endif
                                </td>
                            @endfor
                            <td>
                                <a href="{{ url('kegiatan/' . $activity['id'] . '/ubah?type=result') }}" class="btn btn-raised btn-primary">
                                    Ubah
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END ACTIVITY DETAIL TABLE -->

        <!-- ACTIVITY EXECUTOR TABLE -->
        <div class="panel panel-white">
            <div class="panel-heading">
                <h6 class="panel-title text-semibold">Pelaksana Kegiatan</h6>
            </div>
            <div class="panel-body table-responsive">
                <table class="table table-bordered datatable">
                    <thead>
                        <tr>
                            <th rowspan="2">Kode Rekening</th>
                            <th rowspan="2">Uraian</th>
                            <th rowspan="2">Anggaran</th>
                            <th colspan="2" class="text-center">Realisasi</th>
                        </tr>
                        <tr>
                            <td>Anggaran</td>
                            <td>Fisik</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activity['executor'] as $executor)
                            <tr>
                                <td>{{ $executor['id'] }}</td>
                                <td>{{ $executor['name'] }}</td>
                                <td>Rp.{{ number_format($executor['budget'],2,",",".") }}</td>
                                <td>Rp.{{ number_format($executor['realization']['financial'],2,",",".") }}</td>
                                <td>{{ number_format($executor['realization']['physical'],0,",",".") }}%</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END ACTIVITY EXECUTOR TABLE -->

    </div>
    <!-- END CONTENT -->
@endsection

@section('scripts')
    @parent
@endsection