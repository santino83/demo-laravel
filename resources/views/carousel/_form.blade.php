<form method="POST" action="{{ $carousel->id ? route('admin.carousel.update', $carousel) : route('admin.carousel.store') }}">
    @method($carousel->id ? 'PUT' : 'POST')
    @csrf

    <div class="mb-3">
        <label for="carousel_name" class="required">Name</label>
        <input type="text"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $carousel->name) }}"
               id="carousel_name"
               name="name"
               required autofocus>
        @error('name')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="carousel_page" class="required">Page</label>
        <select id="carousel_page" name="page" class="form-control @error('page') is-invalid @enderror" required>
            <option value="homepage" @if('homepage' == old('page', $carousel->page)) selected="selected" @endif >Home Page</option>
            <option value="other" @if('other' == old('page', $carousel->page)) selected="selected" @endif>Other Page</option>
        </select>
        @error('page')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="carousel_position" class="required">Position</label>
        <input type="text"
               class="form-control @error('position') is-invalid @enderror"
               value="{{ old('position', $carousel->position) }}"
               id="carousel_position"
               name="position"
               required>
        @error('position')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="card">

        <div class="card-body">
            <div class="card-title text-decoration-underline">Advanced Options</div>
            <div class="card-text mt-3">

                <div class="form-check form-switch">
                    <input type="hidden" name="fade" value="0">
                    <input class="form-check-input" name="fade" type="checkbox" role="switch"
                           value="1"
                           id="carousel_fade" {{ old('fade', $carousel->fade) ? 'checked' : '' }}>
                    <label class="form-check-label" for="carousel_fade">Fade Transition</label>
                </div>

                <div class="form-check form-switch">
                    <input type="hidden" name="autoplay" value="0">
                    <input class="form-check-input" name="autoplay" type="checkbox" role="switch"
                           value="1"
                           id="carousel_autoplay" {{ old('autoplay', $carousel->autoplay) ? 'checked' : '' }}>
                    <label class="form-check-label" for="carousel_autoplay">Autoplay</label>
                </div>

                <div class="form-check form-switch">
                    <input type="hidden" name="indicators" value="0">
                    <input class="form-check-input" name="indicators" type="checkbox" role="switch"
                           value="1"
                           id="carousel_indicators" {{ old('indicators', $carousel->indicators) ? 'checked' : '' }}>
                    <label class="form-check-label" for="carousel_indicators">Show Indicators</label>
                </div>

                <div class="form-check form-switch">
                    <input type="hidden" name="controls" value="0">
                    <input class="form-check-input" name="controls" type="checkbox" role="switch"
                           value="1"
                           id="carousel_controls" {{ old('controls', $carousel->controls) ? 'checked' : '' }}>
                    <label class="form-check-label" for="carousel_controls">Show Controls</label>
                </div>

                <div class="mt-3">
                    <label for="carousel_interval">Interval</label>
                    <input type="number" id="carousel_interval" name="interval" min="1" max="100"
                           class="form-control w-auto @error('interval') is-invalid @enderror"
                           aria-describedby="carousel_interval_help"
                           value="{{ old('interval', $carousel->interval) }}">
                    <div id="carousel_interval_help" class="help-text">Time between slides in second. Min 1 second, max
                        100 seconds
                    </div>
                    @error('interval')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

            </div>
        </div>
    </div>


    <button class="btn btn-success mt-3 mb-5" type="submit">
        <i class="bi bi-check fs-4 me-1"></i>{{ isset($button_label) ? $button_label : 'Save'  }}
    </button>

</form>
