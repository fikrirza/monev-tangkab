@extends("layouts.base")

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
            <li>
                <a href="{{ url('program', [ $program->id ]) }}">
                    {{ $program->nama }}
                </a>
            </li>
            <li class="active">
                Ubah
            </li>
        @endslot
    @endcomponent

    <!-- CONTENT -->
    <div class="content">

        <!-- ALERT NOTIFICATION -->
        @include('components.alert.error')
        <!-- /ALERT NOTIFICATION -->

        <!-- PROGRAM FORM -->
        <div class="panel panel-white">
            <div class="panel-heading">
                <h6 class="panel-title text-semibold">Realisasi Program</h6>
            </div>
            <div class="panel-body">
                <form action="{{ url('program', [ $program->id ]) }}" method="POST" class="panel-body">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <div class="row">
                        <div class="col-md-3">
                            <fieldset>
                                <div class="form-group">
                                    <label>Triwulan I:</label>
                                    <input type="number" value="{{ $program->capaian[0] or '' }}" name="capaian[]" class="form-control" required>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-md-3">
                            <fieldset>
                                <div class="form-group">
                                    <label>Triwulan II:</label>
                                    <input type="number" value="{{ $program->capaian[1] or '' }}" name="capaian[]" class="form-control" required>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-md-3">
                            <fieldset>
                                <div class="form-group">
                                    <label>Triwulan III:</label>
                                    <input type="number" value="{{ $program->capaian[2] or '' }}" name="capaian[]" class="form-control" required>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-md-3">
                            <fieldset>
                                <div class="form-group">
                                    <label>Triwulan IV:</label>
                                    <input type="number" value="{{ $program->capaian[3] or '' }}" name="capaian[]" class="form-control" required>
                                </div>
                            </fieldset>
                        </div>

                    </div>

                    <div class="text-right">
                        <a href="{{ url('program', [ $program->id ]) }}" class="btn btn-danger">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan <i class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END PROGRAM FORM -->

    </div>
    <!-- END CONTENT -->
@endsection

@section('scripts')
    @parent
@endsection