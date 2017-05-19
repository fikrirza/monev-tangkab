@extends("layouts.base")

@section('content')
    @component('components.header')
        @slot('title')
            Realisasi
        @endslot

        @slot('description')
            Review data program dan kegiatan realisasi.
        @endslot

        @slot('breadcrumb')
            <li class="active">
                Realisasi
            </li>
        @endslot
    @endcomponent

    <!-- CONTENT -->
    <div class="content">

        <!-- PROGRAM TABLE -->
        <div class="panel panel-white">
            <div class="panel-heading">
                <h6 class="panel-title text-semibold">
                    Realisasi Kegiatan Pembangunan Daerah
                    @if ($skpd != null)
                    - {{ $skpd->name }}
                    @endif
                </h6>
                <div class="heading-elements" style="min-width: 200px;">
                    @if (Auth::check())
                        @if (Auth::user()->skpd_id == null || Auth::user()->skpd_id == '1.01.01.00')
                            <select class="select" onchange="window.location='{{ url('realisasi?skpd=') }}' + this.value">
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
                            <th rowspan="2">Kegiatan</th>
                            <th rowspan="2">Jumlah Anggaran</th>
                            <th rowspan="2">Realisasi Kontrak</th>
                            <th colspan="6" class="text-center">Termin</th>
                            <th rowspan="2" class="text-center">Realisasi Fisik</th>
                        </tr>
                        <tr>
                            <td>I</td>
                            <td>II</td>
                            <td>III</td>
                            <td>IV</td>
                            <td>V</td>
                            <td>VI</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($realizations as $realisasi)
                        <tr>
                            <td>{{ $realisasi->contract }}</td>
                            <td>{{ $realisasi->activity->name }}</td>
                            <td>Rp.{{ number_format($realisasi->activity->budget,2,",",".") }}</td>
                            <td>Rp.{{ number_format($realisasi->value,2,",",".") }}</td>
                            @if ($realisasi->termins->count() > 0)
                                @foreach ($realisasi->termins as $termin)
                                    <td>Rp.{{ $termin->value }}</td>
                                @endforeach
                            @else
                                <td>Rp.0</td>
                                <td>Rp.0</td>
                                <td>Rp.0</td>
                                <td>Rp.0</td>
                                <td>Rp.0</td>
                                <td>Rp.0</td>
                            @endif
                            <td>
                                {{ number_format($realisasi->physical,2,",",".") }}%
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