<div class="alert bg-{{ $type or 'info' }} alert-styled-left">
    <button type="button" class="close" data-dismiss="alert">
        <span>&times;</span>
        <span class="sr-only">Close</span>
    </button>
    {{ $slot }}
</div>