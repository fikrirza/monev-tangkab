<div class="panel panel-body bg-{{ $color or 'blue' }}-400 has-bg-image" style="{{ $style or ''}}">
    <div class="media no-margin">
        <div class="media-body">
            <h3 class="no-margin">{{ $value }}</h3>
            <span class="text-uppercase text-size-mini">{{ $slot }}</span>
        </div>

        <div class="media-right media-middle">
            <i class="{{ $icon or '' }} opacity-75"></i>
        </div>
    </div>
</div>
