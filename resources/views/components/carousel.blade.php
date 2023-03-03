
@if($carousel)

    @php
        $carouselId = $attributes->get('id') ?: 'carousel'.$carousel->id;
    @endphp

    <div id="{{ $carouselId }}"
            {{ $attributes->merge([ 'class' => 'carousel slide' . ($carousel->fade ? ' carousel-fade' : '')])->except('style')->except('id') }}
            @if($carousel->autoplay)
                data-bs-ride="carousel"
            @else
                data-bs-interval="false"
         @endif>

        @if($carousel->indicators)
            <div class="carousel-indicators">
                @for($i = 0; $i < $carousel->carouselImages()->count(); $i++)
                    <button type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide-to="{{ $i }}"
                            class="{{ $i == 0 ? 'active' : '' }}" aria-current="true"
                            aria-label="Slide {{ $i + 1 }}"></button>
                @endfor
            </div>
        @endif

        <div class="carousel-inner" style="{{ $attributes->get('style') }}">
            @foreach($carousel->carouselImages()->get() as $image)
                @php
                    $interval = $image->interval > 0 ? $image->interval : $carousel->interval;
                @endphp

                <div class="carousel-item {{ $loop->first ? 'active' : '' }}"
                     data-bs-interval="{{ $interval * 1000 }}">
                    <img src="{{ url('storage/upload/carousels/' . $carousel->id . '/' . $image->image_path) }}"
                         class="d-block w-100" alt="{{ $image->id }}">
                </div>
            @endforeach
        </div>

        @if($carousel->controls)
            <button class="carousel-control-prev" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        @endif

    </div>

@endif
