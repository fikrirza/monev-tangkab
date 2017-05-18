@extends("layouts.base")

@section('content')
    @component('components.header')
        @slot('title')
            {{  $program->name }}
        @endslot

        @slot('description')
            {{ $program->summary }}
        @endslot

        @slot('breadcrumb')
            <li>
                <a href="{{ url('program') }}">
                    Program
                </a>
            </li>
            <li>
                <a href="{{ url('program', [ $program->id ]) }}">
                    {{ $program->name }}
                </a>
            </li>
            <li class="active">
                Ubah
            </li>
        @endslot
    @endcomponent

    <!-- CONTENT -->
    <div class="content">

        <!-- REALIZATION FORM -->
        <div class="panel panel-white">
            <div class="panel-heading">
                <h6 class="panel-title text-semibold">Realisasi Program</h6>
            </div>
            <div class="panel-body">
                <form action="{{ url('program', [ $program->id ]) }}" method="POST" class="panel-body">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <div class="row">
                        <div class="col-md-12">
                            <fieldset>
                                <div class="form-group">
                                    <label>Uraian:</label>
                                    <textarea rows="5" name="summary" class="form-control" required>{{ $program->summary or '' }}</textarea>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-md-3">
                            <fieldset>
                                <div class="form-group">
                                    <label>Triwulan I:</label>
                                    <input type="number" value="{{ $program->results[0]->value or '' }}" name="realization[]" class="form-control" required>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-md-3">
                            <fieldset>
                                <div class="form-group">
                                    <label>Triwulan II:</label>
                                    <input type="number" value="{{ $program->results[1]->value or '' }}" name="realization[]" class="form-control" required>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-md-3">
                            <fieldset>
                                <div class="form-group">
                                    <label>Triwulan III:</label>
                                    <input type="number" value="{{ $program->results[2]->value or '' }}" name="realization[]" class="form-control" required>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-md-3">
                            <fieldset>
                                <div class="form-group">
                                    <label>Triwulan IV:</label>
                                    <input type="number" value="{{ $program->results[3]->value or '' }}" name="realization[]" class="form-control" required>
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
        <!-- END REALIZATION FORM -->

    </div>
    <!-- END CONTENT -->
@endsection

@section('scripts')
    @parent
@endsection