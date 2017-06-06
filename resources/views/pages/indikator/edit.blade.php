@extends("layouts.base")

@section('content')
    @component('components.header')
        @slot('title')
            {{  $indikator->kegiatan->nama }}
        @endslot

        @slot('description')
            {{ $indikator->kegiatan->program->summary }}
        @endslot

        @slot('breadcrumb')
            <li>
                <a href="{{ url('program') }}">
                    Program
                </a>
            </li>
            <li>
                <a href="{{ url('program', [ $indikator->kegiatan->program->id ]) }}">
                    {{ $indikator->kegiatan->program->nama }}
                </a>
            </li>
            <li>
                <a href="{{ url('kegiatan', $indikator->kegiatan->id) }}">
                    {{ $indikator->kegiatan->nama }}
                </a>
            </li>
            <li class="active">
                Ubah Indikator
            </li>
        @endslot
    @endcomponent

    <!-- CONTENT -->
    <div class="content">

        <!-- ALERT NOTIFICATION -->
        @include('components.alert.error')
        <!-- /ALERT NOTIFICATION -->

        <!-- INDIKATOR FORM -->
        <div class="panel panel-white">
            <div class="panel-heading">
                <h6 class="panel-title text-semibold">Indikator kegiatan</h6>
            </div>
            <div class="panel-body">
                <form action="{{ url('indikator', [ $indikator->id ]) }}" method="POST" class="panel-body">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <div class="row">
                        <div class="col-md-12">
                            <fieldset>
                                <div class="form-group">
                                    <label>Tolak Ukur:</label>
                                    <input type="text" class="form-control" value="{{ $indikator->uraian }}" readonly/>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-md-12">
                            <fieldset>
                                <div class="form-group">
                                    <label>Nilai Target:</label>
                                    <input type="number" value="{{ $indikator->target or '' }}" name="target" class="form-control" required>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-md-12">
                            <fieldset>
                                <div class="form-group">
                                    <label>Satuan Target:</label>
                                    <input type="text" value="{{ $indikator->satuan or '' }}" name="satuan" class="form-control" required>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-md-3">
                            <fieldset>
                                <div class="form-group">
                                    <label>Triwulan I:</label>
                                    <input type="number" value="{{ $indikator->nilai[0] or '' }}" name="nilai[]" class="form-control" required>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-md-3">
                            <fieldset>
                                <div class="form-group">
                                    <label>Triwulan II:</label>
                                    <input type="number" value="{{ $indikator->nilai[1] or '' }}" name="nilai[]" class="form-control" required>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-md-3">
                            <fieldset>
                                <div class="form-group">
                                    <label>Triwulan III:</label>
                                    <input type="number" value="{{ $indikator->nilai[2] or '' }}" name="nilai[]" class="form-control" required>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-md-3">
                            <fieldset>
                                <div class="form-group">
                                    <label>Triwulan IV:</label>
                                    <input type="number" value="{{ $indikator->nilai[3] or '' }}" name="nilai[]" class="form-control" required>
                                </div>
                            </fieldset>
                        </div>

                    </div>

                    <div class="text-right">
                        <a href="{{ url('kegiatan', [ $indikator->kegiatan->id ]) }}" class="btn btn-danger">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan <i class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END INDIKATOR FORM -->

    </div>
    <!-- END CONTENT -->
@endsection

@section('scripts')
    @parent
@endsection