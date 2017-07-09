@extends("layouts.base")

@section('modals')

    <!-- PROGRAM MODAL  -->
    <div id="program-modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Capaian Program</h5>
                </div>

                <form action="{{ url('program', [ $program->id ]) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Triwulan I</label>
                                    <input type="number" value="{{ $program->capaian[0] or '' }}" name="capaian[]" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Triwulan II</label>
                                    <input type="number" value="{{ $program->capaian[1] or '' }}" name="capaian[]" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Triwulan III</label>
                                    <input type="number" value="{{ $program->capaian[2] or '' }}" name="capaian[]" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Triwulan IV</label>
                                    <input type="number" value="{{ $program->capaian[3] or '' }}" name="capaian[]" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary btn-raised">Ubah Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- /PROGRAM MODAL  -->

@endsection

@section('content')
    @component('components.header')
        @slot('title')
            {{  $program->nama }}
        @endslot

        @slot('description')
            {{ $program->uraian }}
        @endslot

        @slot('breadcrumb')
            <li>
                <a href="{{ url('program') }}">
                    Program
                </a>
            </li>
            <li class="active">
                {{ $program->nama }}
            </li>
        @endslot
    @endcomponent

    <!-- CONTENT -->
    <div class="content">

        <!-- ALERT NOTIFICATION -->
        @include('components.alert.error')
        @include('components.alert.success')
        <!-- /ALERT NOTIFICATION -->

        <!-- INDICATOR TABLE -->
        <div class="panel panel-white">
            <div class="panel-heading">
                <h6 class="panel-title text-semibold">Indikator Program</h6>

                <div class="heading-elements">
                </div>
            </div>
            <div class="panel-body table-responsive">
                <table class="table table-bordered datatable" data-paging="false" data-show-info="false" data-searching="false">
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
                            <td>{{ $program->uraian }}</td>
                            <td>Rp.{{ number_format($program->item()->sum('total'),2,",",".") }}
                            @foreach ($program->capaian as $capaian)
                                <td>{{ number_format($capaian,2,".",".") }}%</td>
                            @endforeach
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
            </div>
            <div class="panel-body table-responsive">
                <table class="table table-bordered datatable">
                    <thead>
                        <tr>
                            <th rowspan="2">Kode</th>
                            <th rowspan="2">Kegiatan</th>
                            <th rowspan="2">Jumlah Anggaran</th>
                            <th colspan="2" class="text-center">Realisasi</th>
                            <th rowspan="2" class="text-center">Aksi</th>
                        </tr>
                        <tr>
                            <td>Anggaran</td>
                            <td>Fisik</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($program->kegiatan as $kegiatan)
                        <tr>
                            <td>{{ $kegiatan->rekening }}</td>
                            <td>{{ $kegiatan->nama }}</td>
                            <td>Rp.{{ number_format($kegiatan->item->sum('total'),2,",",".") }}</td>
                            <td class="text-semibold">
                                Rp.{{ number_format($kegiatan->realisasi,2,",",".") }}
                            </td>
                            <td class="text-semibold">
                                {{ $kegiatan->item->avg('fisik') }} %
                            </td>
                            <td class="text-center">
                                <a href="{{ url('kegiatan/' . $kegiatan->id) }}" class="btn btn-raised btn-primary">
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