@if($thematic)

    <div {{ $attributes->merge(['class' => 'row']) }}>
        @foreach($thematic->thematicImages()->get() as $image)
            <div class="{{ $colSize ? $colSize : 'col-12' }}">
                <div class="thematic">
                    <img src="{{ url('storage/upload/thematics/' . $thematic->id . '/' . $image->image_path) }}"
                         alt="{{ $thematic->id }}" class="img-fluid">
                    <div class="thematic-body d-flex flex-column justify-content-end">
                        <div class="thematic-title">{{ $image->title }}</div>
                        <div class="thematic-text pb-3">{{ $image->description }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endif
