@extends("layouts.base")

{{-- Lihat ActivityController untuk melihat data mock --}}

@section('content')
    @component('components.header')
        @slot('title')
            Program / Kegiatan
        @endslot

        @slot('description')
            Review data kegiatan yang sudah terdaftar.
        @endslot

        @slot('breadcrumb')
            <li class="active">
                Program
            </li>
        @endslot
    @endcomponent

    <!-- CONTENT -->
    <div class="content">

        <!-- ACTIVITIES TABLE -->
        <div class="panel">
            <div class="panel-heading">
                <h6 class="panel-title text-semibold">Program / Kegiatan Badan Perencanaan Pembangunan Daerah</h6>
                <div class="heading-elements">
                    <a href="{{ url('program/buat') }}" class="btn btn-raised btn-success">
                        Tambah Program
                    </a>
                </div>
            </div>
            <div class="panel-body table-responsive">
                <table class="table table-bordered datatable">
                    <thead>
                        <tr>
                            <th rowspan="2">Kode</th>
                            <th rowspan="2">Program</th>
                            <th rowspan="2">Jumlah Anggaran</th>
                            <th colspan="4" class="text-center">Capaian</th>
                            <th colspan="2" class="text-center">Realisasi</th>
                            <th rowspan="2" class="text-center">Aksi</th>
                        </tr>
                        <tr>
                            <td>I</td>
                            <td>II</td>
                            <td>III</td>
                            <td>IV</td>
                            <td>Anggaran</td>
                            <td>Fisik</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($programs as $program)
                        <tr>
                            <td>{{ $program['id'] }}</td>
                            <td>{{ $program['name'] }}</td>
                            <td>Rp.{{ number_format($program['budget'],2,",",".") }}
                            <td>25%</td>
                            <td>50%</td>
                            <td>75%</td>
                            <td>100%</td>
                            <td class="text-semibold">Rp.{{ number_format($program['budget'],2,",",".") }}</td>
                            <td class="text-semibold">100%</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-raised btn-primary">
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
    <script type="text/javascript" src="{{ asset('assets/js/pages/activities.js') }}"></script>
@endsection