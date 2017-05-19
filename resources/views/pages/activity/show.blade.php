@extends("layouts.base")

@section('content')
    @component('components.header')
        @slot('title')
            {{ $activity->name }}
        @endslot

        @slot('description')
            {{ $activity->program->summary }}
        @endslot

        @slot('breadcrumb')
            <li>
                <a href="{{ url('program') }}">
                    Program
                </a>
            </li>
            <li>
                <a href="{{ url('program', $activity->program->id) }}">
                    {{ $program->name }}
                </a>
            </li>
            <li class="active">
                {{ $activity->name }}
            </li>
        @endslot
    @endcomponent

    <!-- CONTENT -->
    <div class="content">

        <!-- ACTIVITY DETAIL TABLE -->
        <div class="panel panel-white">
            <div class="panel-heading">
                <h6 class="panel-title text-semibold">{{ $activity['name'] }}</h6>

                <div class="heading-elements">
                    @if (Auth::check())
                        @if (Auth::user()->skpd_id == $program->skpd_id)
                            <a href="{{ url('realisasi/buat?kegiatan=' . $activity->id) }}" class="btn btn-primary btn-raised">
                                Realisasi Kegiatan
                            </a>
                        @endif
                    @endif

                    
                </div>
            </div>
            <div class="panel-body table-responsive">
                <table class="table table-bordered datatable" data-paging="false" data-show-info="false" data-searching="false" data-ordering="false">
                    <thead>
                        <tr>
                            <th rowspan="2">Indikator</th>
                            <th rowspan="2">Tolak Ukur</th>
                            <th rowspan="2">Target</th>
                            <th colspan="4" class="text-center">Realisasi</th>
                            @if (Auth::check())
                                @if (Auth::user()->skpd_id == $program->skpd_id)
                                    <th rowspan="2" class="text-center">Aksi</th>
                                @endif
                            @endif
                        </tr>
                        <tr>
                            <td>I</td>
                            <td>II</td>
                            <td>III</td>
                            <td>IV</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activity->indicators as $indicator)
                            <tr>
                                <td>{{ $indicator->name }}</td>
                                <td>{{ $indicator->description }}</td>
                                <td>
                                    @if ($indicator->unit == null)
                                        Rp.{{ number_format($indicator->target,2,',','.') }}
                                    @else
                                        {{ $indicator->target . ' ' . $indicator->unit }} 
                                    @endif
                                </td>
                                @if ($indicator->unit == null)
                                    <td class="text-center" colspan="5">
                                        -
                                    </td>
                                    @php($loopCount = 3)
                                    @if (Auth::check())
                                        @if (Auth::user()->skpd_id == $program->skpd_id)
                                            @php($loopCount = 4)
                                        @endif
                                    @endif

                                    @for ($i = 0; $i < $loopCount; $i++)
                                        <td style="display: none;"></td>
                                    @endfor                       
                                @else
                                    @foreach ($indicator->results as $result)
                                        <td>{{ $result->value . ' ' . $indicator->unit }}</td>
                                    @endforeach
                                    @if (Auth::check())
                                        @if (Auth::user()->skpd_id == $program->skpd_id)
                                            <td>
                                                <a href="{{ url('indikator', [ $indicator->id, 'ubah' ]) }}" class="btn btn-raised btn-primary">
                                                    Ubah
                                                </a>              
                                            </td>
                                        @endif
                                    @endif

                                @endif
                            </tr>
                        @endforeach
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
                        @foreach ($activity->executors as $executor)
                            <tr>
                                <td>{{ $executor->id }}</td>
                                <td>{{ $executor->name }}</td>
                                <td>Rp.{{ number_format($executor->budget,2,",",".") }}</td>
                                <td>Rp.{{ number_format($executor->financial,2,",",".") }}</td>
                                <td>{{ number_format($executor->physical,0,",",".") }}%</td>
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