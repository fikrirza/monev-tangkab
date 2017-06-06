@if (session('success') || (isset($success) && $success))
    @component('components.alert.index')
        @slot('type')
            success
        @endslot

        Permintaan anda berhasil diproses.
    @endcomponent
@endif