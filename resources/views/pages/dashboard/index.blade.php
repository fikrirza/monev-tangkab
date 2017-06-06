@extends("layouts.base")

@section('content')
    @component('components.header')
        @slot('title')
            E-Monev Pemkab Tanggerang
        @endslot

        @slot('description')
            One Team, One Spirit, One Goal, Tangerang GEMILANG
        @endslot

        @slot('breadcrumb')
        @endslot
    @endcomponent

    <!-- CONTENT -->
    <div class="content">

        <!-- ALERT NOTIFICATION -->
        @include('components.alert.error')
        <!-- /ALERT NOTIFICATION -->

        <!-- STATISTICS -->
        <div class="row">

            <div class="col-sm-6 col-md-3">
                @component('components.widgets.statistic')
                    @slot('icon')
                        fa fa-clone fa-3x
                    @endslot
                    @slot('value')
                        {{ count($program) }}
                    @endslot
                    

                    total program
                @endcomponent
            </div>

            <div class="col-sm-6 col-md-3">
                @component('components.widgets.statistic')
                    @slot('color')
                        violet
                    @endslot
                    @slot('icon')
                        fa fa-calendar fa-3x
                    @endslot
                    @slot('value')
                        {{ count($kegiatan) }}
                    @endslot
                    

                    kegiatan
                @endcomponent
            </div>

            <div class="col-sm-6 col-md-3">
                @component('components.widgets.statistic')
                    @slot('color')
                        indigo
                    @endslot
                    @slot('icon')
                        fa fa-tasks fa-3x
                    @endslot
                    @slot('value')
                        {{ count($item) }}
                    @endslot
                    

                    item kegiatan
                @endcomponent
            </div>

            <div class="col-sm-6 col-md-3">
                @component('components.widgets.statistic')
                    @slot('color')
                        orange
                    @endslot
                    @slot('icon')
                        fa fa-info-circle fa-3x
                    @endslot
                    @slot('value')
                        {{ count($indikator) }}
                    @endslot
                    

                    indikator
                @endcomponent
            </div>


        </div>
        <!-- END STATISTICS -->

        <div class="row">

        </div>

    </div>
    <!-- END CONTENT -->
@endsection

@section('scripts')
    @parent

    <script type="text/javascript" src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
@endsection