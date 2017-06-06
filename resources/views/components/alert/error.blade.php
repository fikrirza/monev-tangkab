@if (count($errors) > 0)
    @component('components.alert.index')
        @slot('type')
            danger
        @endslot

        @if(count($errors) == 1)
            {{ $errors->first() }}
        @else
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    @endcomponent
@endif