@extends("layouts.base")

@section('content')
    @component('components.header')
        @slot('title')
            Realisasi Kegiatan
        @endslot

        @slot('description')
            {{  $activity->name }}
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
                Realisasi
            </li>
        @endslot
    @endcomponent

    <!-- CONTENT -->
    <div class="content">

        <!-- REALIZATION FORM -->
        <div class="panel panel-white">
            <div class="panel-heading">
                <h6 class="panel-title text-semibold">Realisasi Kegiatan</h6>
            </div>
            <div class="panel-body">
                <form action="{{ url('realisasi', isset($realization) ? [ $realization->id ] : []) }}" method="POST" class="panel-body">
                    {{ csrf_field() }}
                    @if (isset($realization))
                        {{ method_field('PATCH') }}
                    @endif
                    <input type="hidden" name="activity" class="form-control" value="{{ $activity->id or '' }}" readonly/>
                    <div class="row">
                        <div class="col-md-12">
                            <fieldset>
                                <div class="form-group">
                                    <label>Uraian:</label>
                                    <input type="text" class="form-control" value="{{ $activity->name or '' }}" readonly/>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-md-12">
                            <fieldset>
                                <div class="form-group">
                                    <label>Anggaran:</label>
                                    <input type="text" class="form-control" value="Rp.{{ number_format($activity->budget,2,',','.') }}" readonly/>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-md-12">
                            <fieldset>
                                <div class="form-group">
                                    <label>Realisasi Kontrak:</label>
                                    <input type="number" class="form-control" value="{{ $realization->value or '' }}" name="value"/>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-md-12">
                            <fieldset>
                                <div class="form-group">
                                    <label>Nomor Kontrak:</label>
                                    <input type="text" value="{{ $realiaztion->contract or '' }}" name="contract" class="form-control" required>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-md-12">
                            <fieldset>
                                <div class="form-group">
                                    <label>Pelaksana:</label>
                                    <input type="text" value="{{ $realiaztion->executor or '' }}" name="executor" class="form-control" required>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-md-12">
                            <fieldset>
                                <div class="form-group">
                                    <label>Refensi:</label>
                                    <input type="number" class="form-control" value="{{ $realization->refensi or '' }}" name="refensi"/>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-md-12">
                            <fieldset>
                                <div class="form-group">
                                    <label>Realisasi Fisik:</label>
                                    <input type="number" class="form-control" value="{{ $realization->physical or '' }}" name="physical"/>
                                </div>
                            </fieldset>
                        </div>

                        @for ($i = 0; $i < 6; $i++)
                            <div class="col-md-2">
                                <fieldset>
                                    <div class="form-group">
                                        <label>Termin {{ $i + 1 }}:</label>
                                        <input type="number" value="{{ $realization->termins[$i]->value or '0' }}" name="termins[]" class="form-control" required>
                                    </div>
                                </fieldset>
                            </div>
                        @endfor

                    </div>

                    <div class="text-right">
                        <a href="{{ url('realisasi') }}" class="btn btn-danger">Batal</a>
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