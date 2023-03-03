<form method="POST" action="{{ $thematic->id ? route('admin.thematic.update', $thematic) : route('admin.thematic.store') }}">
    @method($thematic->id ? 'PUT' : 'POST')
    @csrf

    <div class="mb-3">
        <label for="thematic_name" class="required">Name</label>
        <input type="text"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $thematic->name) }}"
               id="thematic_name"
               name="name"
               required autofocus>
        @error('name')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="thematic_page" class="required">Page</label>
        <select id="thematic_page" name="page" class="form-control @error('page') is-invalid @enderror" required>
            <option value="homepage" @if('homepage' == old('page', $thematic->page)) selected="selected" @endif >Home Page</option>
            <option value="other" @if('other' == old('page', $thematic->page)) selected="selected" @endif>Other Page</option>
        </select>
        @error('page')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="thematic_position" class="required">Position</label>
        <input type="text"
               class="form-control @error('position') is-invalid @enderror"
               value="{{ old('position', $thematic->position) }}"
               id="thematic_position"
               name="position"
               required>
        @error('position')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button class="btn btn-success mt-3 mb-5" type="submit">
        <i class="bi bi-check fs-4 me-1"></i>{{ isset($button_label) ? $button_label : 'Save'  }}
    </button>

</form>
