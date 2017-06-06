@if (Auth::user()->skpd_id == null || Auth::user()->skpd_id == '1.01.01.00')
    <select class="select" onchange="window.location='{{ url(Request::url() . '?skpd=') }}' + this.value">
        <option value="" {{ Request::get('skpd') == null ? 'selected' : '' }}>Semua</option> 
        @foreach(\App\Models\Skpd::all() as $dinas)
            <option value="{{ $dinas->id }}" {{ Request::get('skpd', Auth::user()->skpd_id) == $dinas->id ? 'selected' : '' }}>
                {{ $dinas->nama }}
            </option>
        @endforeach
    </select>
@endif