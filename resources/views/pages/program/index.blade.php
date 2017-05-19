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
                    - {{ $skpd->name }}
                    @endif
                </h6>
                <div class="heading-elements" style="min-width: 200px;">
                    @if (Auth::check())
                        @if (Auth::user()->skpd_id == null || Auth::user()->skpd_id == '1.01.01.00')
                            <select class="select" onchange="window.location='{{ url('program?skpd=') }}' + this.value">
                                <option value="" {{ Request::get('skpd') == null ? 'selected' : '' }}>Semua</option> 
                                @foreach(\App\Models\Skpd::all() as $dinas)
                                    <option value="{{ $dinas->id }}" {{ Request::get('skpd') == $dinas->id ? 'selected' : '' }}>{{ $dinas->name }}</option>
                                @endforeach
                            </select>
                        @endif
                    @endif
                </div>
            </div>
            <div class="panel-body table-responsive">
                <table class="table table-bordered datatable" data-sort="0" data-sort-type="asc">
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
                            <td>{{ $program->id }}</td>
                            <td>{{ $program->name }}</td>
                            <td>Rp.{{ number_format($program->activities()->sum('budget'),2,",",".") }}</td>
                            @if ($program->results->count() > 0)
                                @foreach ($program->results as $result)
                                    <td>{{ $result->value }}%</td>
                                @endforeach
                            @else
                                <td>25%</td>
                                <td>50%</td>
                                <td>75%</td>
                                <td>100%</td>
                            @endif
                            <td class="text-semibold">Rp.{{ number_format($program->activities()->sum('budget'),2,",",".") }}</td>
                            <td class="text-semibold">100%</td>
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