@extends("layouts.base")

@section('content')
    @component('components.header')
        @slot('title')
            {{  $activity->name }}
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
                <a href="{{ url('program', [ $activity->program->id ]) }}">
                    {{ $activity->program->name }}
                </a>
            </li>
            <li>
                <a href="{{ url('kegiatan', $activity->id) }}">
                    {{ $activity->name }}
                </a>
            </li>
            <li class="active">
                Ubah Indikator
            </li>
        @endslot
    @endcomponent

    <!-- CONTENT -->
    <div class="content">

        <!-- REALIZATION FORM -->
        <div class="panel panel-white">
            <div class="panel-heading">
                <h6 class="panel-title text-semibold">Indikator kegiatan</h6>
            </div>
            <div class="panel-body">
                <form action="{{ url('indikator', [ $indicator->id ]) }}" method="POST" class="panel-body">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <div class="row">
                        <div class="col-md-12">
                            <fieldset>
                                <div class="form-group">
                                    <label>Tolak Ukur:</label>
                                    <input type="text" class="form-control" value="{{ $indicator->description }}" readonly/>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-md-12">
                            <fieldset>
                                <div class="form-group">
                                    <label>Nilai Target:</label>
                                    <input type="number" value="{{ $indicator->target or '' }}" name="target" class="form-control" required>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-md-12">
                            <fieldset>
                                <div class="form-group">
                                    <label>Satuan Target:</label>
                                    <input type="text" value="{{ $indicator->unit or '' }}" name="unit" class="form-control" required>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-md-3">
                            <fieldset>
                                <div class="form-group">
                                    <label>Triwulan I:</label>
                                    <input type="number" value="{{ $indicator->results[0]->value or '' }}" name="realization[]" class="form-control" required>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-md-3">
                            <fieldset>
                                <div class="form-group">
                                    <label>Triwulan II:</label>
                                    <input type="number" value="{{ $indicator->results[1]->value or '' }}" name="realization[]" class="form-control" required>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-md-3">
                            <fieldset>
                                <div class="form-group">
                                    <label>Triwulan III:</label>
                                    <input type="number" value="{{ $indicator->results[2]->value or '' }}" name="realization[]" class="form-control" required>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-md-3">
                            <fieldset>
                                <div class="form-group">
                                    <label>Triwulan IV:</label>
                                    <input type="number" value="{{ $indicator->results[3]->value or '' }}" name="realization[]" class="form-control" required>
                                </div>
                            </fieldset>
                        </div>

                    </div>

                    <div class="text-right">
                        <a href="{{ url('kegiatan', [ $activity->id ]) }}" class="btn btn-danger">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan <i class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END REALIZATION FORM -->

    </div>
    <!-- END CONTENT -->
@endsection

@section('scripts')
    @parent
@endsection