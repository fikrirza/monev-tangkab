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
            <li class="active">
                {{ $program['name'] }}
            </li>
        @endslot
    @endcomponent

    <!-- CONTENT -->
    <div class="content">

        <!-- INDICATOR TABLE -->
        <div class="panel panel-white">
            <div class="panel-heading">
                <h6 class="panel-title text-semibold">Indikator Program</h6>
            </div>
            <div class="panel-body table-responsive">
                <table class="table table-bordered datatable" data-paging="false" data-show-info="false">
                    <thead>
                        <tr>
                            <th rowspan="2">Uraian</th>
                            <th rowspan="2">Jumlah Anggaran</th>
                            <th colspan="4" class="text-center">Target</th>
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
                            <td>{{ $program['description'] }}</td>
                            <td>Rp.{{ number_format($program['budget'],2,",",".") }}
                            <td>{{ $program['target'][0] }}%</td>
                            <td>{{ $program['target'][1] }}%</td>
                            <td>{{ $program['target'][2] }}%</td>
                            <td>{{ $program['target'][3] }}%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END INDICATOR TABLE -->

        <!-- ACTIVITIES TABLE -->
        <div class="panel panel-white">
            <div class="panel-heading">
                <h6 class="panel-title text-semibold">Daftar Kegiatan</h6>
                <div class="heading-elements">
                    <a href="{{ url('kegiatan/buat?program=' . $program['id']) }}" class="btn btn-raised btn-success">
                        Tambah Kegiatan
                    </a>
                </div>
            </div>
            <div class="panel-body table-responsive">
                <table class="table table-bordered datatable">
                    <thead>
                        <tr>
                            <th rowspan="2">Kode</th>
                            <th rowspan="2">Kegiatan</th>
                            <th rowspan="2">Jumlah Anggaran</th>
                            <th colspan="4" class="text-center">Capaian</th>
                            <th colspan="2" class="text-center">Realisasi</th>
                            <th rowspan="2" class="text-center">Aksi</th>
                        </tr>
                        <tr>
                            <td>I</td>
                            <td>II</td>
                            <td>III</td>
                            <td>IV</td>
                            <td>Anggaran</td>
                            <td>Fisik</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($program['activities'] as $activity)
                        <tr>
                            <td>{{ $activity['id'] }}</td>
                            <td>{{ $activity['name'] }}</td>
                            <td>Rp.{{ number_format($activity['budget'],2,",",".") }}</td>
                            <td>25%</td>
                            <td>50%</td>
                            <td>75%</td>
                            <td>100%</td>
                            <td class="text-semibold">Rp.{{ number_format($activity['budget'],2,",",".") }}</td>
                            <td class="text-semibold">100%</td>
                            <td class="text-center">
                                <a href="{{ url('kegiatan/' . $activity['id'] . '?program=' . $program['id']) }}" class="btn btn-raised btn-primary">
                                    Lihat Detil
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END ACTIVITIES TABLE -->

    </div>
    <!-- END CONTENT -->
@endsection

@section('scripts')
    @parent
@endsection