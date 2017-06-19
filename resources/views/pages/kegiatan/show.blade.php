@extends("layouts.base")

@section('content')
    @component('components.header')
        @slot('title')
            {{ $kegiatan->nama }}
        @endslot

        @slot('description')
            {{ $kegiatan->program->uraian }}
        @endslot

        @slot('breadcrumb')
            <li>
                <a href="{{ url('program') }}">
                    Program
                </a>
            </li>
            <li>
                <a href="{{ url('program', $kegiatan->program->id) }}">
                    {{ $kegiatan->program->nama }}
                </a>
            </li>
            <li class="active">
                {{ $kegiatan->nama }}
            </li>
        @endslot
    @endcomponent

    <!-- CONTENT -->
    <div class="content">

        <!-- ALERT NOTIFICATION -->
        @include('components.alert.success')
        @include('components.alert.error')
        <!-- /ALERT NOTIFICATION -->

        <!-- KEGIATAN DETAIL TABLE -->
        <div class="panel panel-white">
            <div class="panel-heading">
                <h6 class="panel-title text-semibold">
                    {{ $kegiatan->nama }}
                </h6>

                <div class="heading-elements">
                    @if (Auth::user()->skpd_id == $kegiatan->program->skpd_id)
                        <a href="{{ url('realisasi/buat?kegiatan=' . $kegiatan->id) }}" class="btn btn-primary btn-raised">
                            Realisasi Kegiatan
                        </a>
                    @endif
                </div>
            </div>
            <div class="panel-body table-responsive">
                <table class="table table-bordered datatable" data-paging="false" data-show-info="false" data-searching="false" data-ordering="false" data-actions="excel,pdf,print">
                    <thead>
                        <tr>
                            <th rowspan="2">Indikator</th>
                            <th rowspan="2">Tolak Ukur</th>
                            <th rowspan="2">Target</th>
                            <th colspan="4" class="text-center">Realisasi</th>
                            @if (Auth::user()->skpd_id == $kegiatan->program->skpd_id)
                                <th rowspan="2" class="text-center">Aksi</th>
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
                        @foreach ($kegiatan->indikator as $indikator)
                            <tr>
                                <td>{{ $indikator->nama }}</td>
                                <td>
                                    @if ($indikator->nama == 'MASUKAN')
                                        Jumlah Dana
                                    @else
                                        {{ $indikator->uraian }}
                                    @endif
                                </td>
                                <td>
                                    @if ($indikator->nama == 'MASUKAN')
                                        Rp.{{ number_format($kegiatan->item->sum('total'),2,",",".") }}
                                    @else
                                        {{ $indikator->target . ' ' . $indikator->satuan }} 
                                    @endif
                                </td>
                                @if ($indikator->satuan == null)
                                    <td class="text-center" colspan="5">
                                        -
                                    </td>
                                    @php($loopCount = 3)
                                    @if (Auth::user()->skpd_id == $kegiatan->program->skpd_id)
                                        @php($loopCount = 4)
                                    @endif

                                    @for ($i = 0; $i < $loopCount; $i++)
                                        <td style="display: none;"></td>
                                    @endfor                       
                                @else
                                    @foreach ($indikator->nilai as $nilai)
                                        <td>{{ round($nilai) . ' ' . $indikator->satuan }}</td>
                                    @endforeach
                                    @if (Auth::user()->skpd_id == $kegiatan->program->skpd_id)
                                        <td>
                                            <a href="{{ url('indikator', [ $indikator->id, 'ubah' ]) }}" class="btn btn-raised btn-primary">
                                                Ubah
                                            </a>              
                                        </td>
                                    @endif
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END KEGIATAN DETAIL TABLE -->

        <!-- ITEM KEGIATAN TABLE -->
        <div class="panel panel-white">
            <div class="panel-heading">
                <h6 class="panel-title text-semibold">Item Kegiatan</h6>
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
                        @foreach ($kegiatan->item->unique('rekening') as $item)
                            <tr>
                                <td>{{ $item->rekening }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>Rp.{{ number_format($item->total,2,",",".") }}</td>
                                <td>Rp.{{ number_format($item->realisasi,2,",",".") }}</td>
                                <td>{{ number_format($item->fisik,0,",",".") }}%</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END ITEM KEGIATAN TABLE -->

    </div>
    <!-- END CONTENT -->
@endsection

@section('scripts')
    @parent
@endsection