@extends("layouts.base")

@section('content')
    @component('components.header')
        @slot('title')
            Laporan Triwulan
        @endslot

        @slot('description')
            Laporan Kegiatan Triwulan
        @endslot

        @slot('breadcrumb')
            <li class="active">
                Laporan
            </li>
        @endslot
    @endcomponent

    <!-- CONTENT -->
    <div class="content">

        <!-- PROGRAM TABLE -->
        <div class="panel panel-white">
            <div class="panel-heading">
                <h6 class="panel-title text-semibold">
                    Laporan Triwulan Program / Kegiatan Badan Perencanaan Pembangunan Daerah 
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
                <table class="table table-bordered datatable" data-ordering="false">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Program / Kegiatan</th>
                            <th>Jumlah Anggaran</th>
                            <th>Realisasi Fisik</th>
                            <th>Realisasi Keuangan</th>
                            <th>Indikator</th>
                            <th>Target</th>
                            <th>Realisasi</th>
                            <th>Capaian</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($programs as $program)
                        <tr>
                            <td>{{ $program->id }}</td>
                            <td colspan="8">{{ $program->name }}</td>
                            @for ($i = 0; $i < 7; $i++)
                                <td style="display: none;"></td>
                            @endfor
                        </tr>
                            @foreach ($program->activities as $activity)
                            <tr>
                                <td>{{ $activity->id }}</td>
                                <td>{{ $activity->name }}</td>
                                <td>Rp.{{ number_format($activity->budget,2,",",".") }}</td>
                                <td>{{ $activity->physical }}%</td>
                                <td>Keu</td>
                                <td>{{ $activity->indicators()->where('name', 'Hasil')->first()->description or '' }}</td>
                                <td>100%</td>
                                <td class="text-semibold">Rp.{{ number_format($activity->executors()->sum('budget'),2,",",".") }}</td>
                                <td class="text-semibold">{{ $activity->results()->max('value') }}%</td>
                            </tr>
                            @endforeach
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