@extends("layouts.base")

@section('content')
    @component('components.header')
        @slot('title')
            Program dan Kegiatan
        @endslot

        @slot('description')
            Review data program dan kegiatan.
        @endslot

        @slot('breadcrumb')
            <li class="active">
                Program
            </li>
        @endslot
    @endcomponent

    <!-- CONTENT -->
    <div class="content">

        <!-- PROGRAM TABLE -->
        <div class="panel panel-white">
            <div class="panel-heading">
                <h6 class="panel-title text-semibold">
                    Program / Kegiatan Badan Perencanaan Pembangunan Daerah 
                    @if ($skpd != null)
                        - {{ $skpd->nama }}
                    @endif
                </h6>
                <div class="heading-elements" style="min-width: 200px;">
                    @include('components.skpd-selector')
                </div>
            </div>
            <div class="panel-body table-responsive">
                <table class="table table-bordered datatable" data-sort="0" data-sort-type="asc" data-actions="excel,pdf,print">
                    <thead>
                        <tr>
                            <th rowspan="2">Kode</th>
                            <th rowspan="2">Program</th>
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
                        @foreach ($programs as $program)
                        <tr>
                            <td>{{ $program->rekening }}</td>
                            <td>{{ $program->nama }}</td>
                            <td>Rp.{{ number_format($program->item()->sum('total'),2,",",".") }}</td>
                            @foreach ($program->capaian as $capaian)
                                <td>{{ number_format($capaian,2,",",".") }}%</td>
                            @endforeach
                            <td class="text-semibold">
                                Rp.{{ number_format($program->realisasi,2,",",".") }}
                            </td>
                            <td class="text-semibold">{{ $program->fisik }}%</td>
                            <td class="text-center">
                                <a href="{{ url('program', $program->id) }}" class="btn btn-raised btn-primary">
                                    Lihat Detil
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END PROGRAM TABLE -->

    </div>
    <!-- END CONTENT -->
@endsection

@section('scripts')
    @parent
@endsection