<div {{ $attributes->merge(['class' => $makeBoxClass()]) }}>

    {{-- Box title and description --}}
    <div class="inner">
        @isset($title)
            <h3>{{ $title }}</h3>
        @endisset

        @isset($text)
            <h5>{{ $text }}</h5>
        @endisset
    </div>

    {{-- Box icon --}}
    @isset($icon)
        <div class="icon">
            <i class="{{ $icon }}"></i>
        </div>
    @endisset

    {{-- Box link --}}
    @isset($url)
        <a href="{{ $url }}" class="small-box-footer">

            @if (!empty($urlText))
                {{ $urlText }}
            @endif

            <i class="fas fa-lg fa-arrow-circle-right"></i>
        </a>
    @endisset

    {{-- Box overlay --}}
    <div class="{{ $makeOverlayClass() }}">
        <i class="fas fa-2x fa-spin fa-sync-alt text-gray"></i>
    </div>

</div>
