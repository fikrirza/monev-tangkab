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

        <!-- TRIWULAN REPORT TABLE -->
        <div class="panel panel-white">
            <div class="panel-heading">
                <h6 class="panel-title text-semibold">
                    Laporan Triwulan Program
                    @if (isset($skpd) && $skpd != null)
                        - {{ $skpd->nama }}
                    @elseif (!isset($skpd) && Auth::user()->skpd_id != '1.01.01.00')
                        - {{ Auth::user()->skpd->nama }}
                    @endif
                </h6>
                <form action="#" class="heading-elements" style="min-width: 200px;">

                    <div class="skpd-selector" style="display: inline-block; margin-right: 20px; width: 280px;">
                        @if (Auth::user()->skpd_id == null || Auth::user()->skpd_id == '1.01.01.00')
                            <select class="select" name="skpd">
                                <option value="" {{ Request::get('skpd') == null ? 'selected' : '' }}>Semua</option> 
                                @foreach(\App\Models\Skpd::all() as $dinas)
                                    <option value="{{ $dinas->id }}" {{ Request::get('skpd', Auth::user()->skpd_id) == $dinas->id ? 'selected' : '' }}>
                                        {{ $dinas->nama }}
                                    </option>
                                @endforeach
                            </select>
                        @endif
                    </div>

                    <div class="triwulan-selector" style="display: inline-block; width:120px;">
                        <select class="select" name="triwulan">
                            <option value="0" {{ old('triwulan', 0) == 0 ? 'selected' : ''}}>Triwulan I</option>
                            <option value="1" {{ old('triwulan', 0) == 1 ? 'selected' : ''}}>Triwulan II</option>
                            <option value="2" {{ old('triwulan', 0) == 2 ? 'selected' : ''}}>Triwulan III</option>
                            <option value="3" {{ old('triwulan', 0) == 3 ? 'selected' : ''}}>Triwulan IV</option>
                        </select>
                    </div>

                    <input type="submit" value="Cari" class="btn btn-primary" style="display: inline-block; margin-left: 20px;">
                </form>
            </div>
            <div class="panel-body table-responsive">
                <table class="table table-bordered datatable" data-ordering="false" data-perpage="10">
                    <thead>
                        <tr>
                            <th rowspan="2">Kode</th>
                            <th rowspan="2">Program / Kegiatan</th>
                            <th rowspan="2">Jumlah Anggaran</th>
                            <th colspan="2">Persentase Realisasi</th>
                            <th rowspan="2">Indikator</th>
                            <th rowspan="2">Target</th>
                            <th rowspan="2">Realisasi</th>
                            <th rowspan="2">Capaian</th>
                        </tr>
                        <tr>
                            <td>Anggaran</td>
                            <td>Fisik</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($programs as $program)
                            @php($total_fisik    = $program->item->sum('fisik') == 0 ? 1 : $program->item->sum('fisik'))
                            @php($total_keuangan = $program->item->sum('total') == 0 ? 1 : $program->item->sum('total'))
                            @php($fisik          = ($program->item->sum('fisik') / 4) * (old('triwulan', 0) + 1))
                            @php($keuangan       = ($program->item->sum('realisasi') / 4) * (old('triwulan', 0) + 1))

                            <tr>
                                <td>{{ $program->rekening }}</td>
                                <td>{{ $program->nama }}</td>
                                <td>Rp.{{ number_format($total_keuangan,2,".",".") }}</td>
                                <td>{{ number_format(($keuangan / $total_keuangan) * 100,2,".",".") }}%</td>
                                <td>{{ number_format(($fisik / $total_fisik) * 100,2,".",".") }}%</td>
                                <td>-</td>
                                <td>-</td>
                                <td>Rp.{{ number_format($keuangan,2,".",".") }}</td>
                                <td>{{ number_format((((($fisik / $total_fisik) * 100 + ($keuangan / $total_keuangan) * 100) / 2) / 4) * (old('triwulan', 0) + 1),2,".",".") }}%</td>
                            </tr>
                            @foreach($program->kegiatan as $kegiatan)
                                @php($prop           = 'nilai_' . (old('triwulan', 0) + 1))
                                @php($total_fisik    = $kegiatan->item->sum('fisik') == 0 ? 1 : $kegiatan->item->sum('fisik'))
                                @php($total_keuangan = $kegiatan->item->sum('total') == 0 ? 1 : $kegiatan->item->sum('total'))
                                @php($fisik          = ($kegiatan->item->sum('fisik') * 4) / (old('triwulan', 0) + 1))
                                @php($keuangan       = ($kegiatan->item->sum('realisasi') * 4) / (old('triwulan', 0) + 1))

                                <tr>
                                    <td>{{ $kegiatan->rekening }}</td>
                                    <td>{{ $kegiatan->nama }}</td>
                                    <td>{{ $kegiatan->item()->sum('total') }}</td>
                                    <td>{{ number_format(($keuangan / $total_keuangan) * 100,2,".",".") }}%</td>
                                    <td>{{ number_format(($fisik / $total_fisik) * 100,2,".",".") }}%</td>
                                    <td colspan="2" class="text-center">-</td>
                                    <td style="display:none;"></td>
                                    <td class="text-center">Rp.{{ number_format($keuangan,2,".",".") }}</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    @php($indikator = $kegiatan->indikator->where('nama', 'KELUARAN')->first())
                                    @for ($i = 0; $i < 5; $i++)
                                        <td></td>
                                    @endfor
                                    @if ($indikator != null)
                                        <td>{{ $indikator->uraian or '-' }}</td>
                                        <td>{{ ($indikator->target . ' ' . $indikator->satuan) }}</td>
                                        <td>{{ (round($indikator->$prop) . ' ' . $indikator->satuan) }}</td>
                                        <td>-</td>
                                    @else
                                        <td colspan="4">-</td>
                                        @for ($i = 0; $i < 3; $i++)
                                            <td style="display:none;"></td>
                                        @endfor
                                    @endif
                                </tr>
                                <tr>
                                    @php($indikator = $kegiatan->indikator->where('nama', 'HASIL')->first())
                                    @for ($i = 0; $i < 5; $i++)
                                        <td></td>
                                    @endfor
                                    @if ($indikator != null)
                                        <td>{{ $indikator->uraian or '-' }}</td>
                                        <td>{{ ($indikator->target . ' ' . $indikator->satuan) }}</td>
                                        <td>{{ (round($indikator->$prop) . ' ' . $indikator->satuan) }}</td>
                                        <td>-</td>
                                    @else
                                        <td colspan="4">-</td>
                                        @for ($i = 0; $i < 3; $i++)
                                            <td style="display:none;"></td>
                                        @endfor
                                    @endif
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END TRIWULAN REPORT TABLE -->

    </div>
    <!-- END CONTENT -->
@endsection

@section('scripts')
    @parent
@endsection