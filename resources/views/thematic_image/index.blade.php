@extends('layouts.admin')

@section('title')
    Thematic Images
@overwrite

@section('content')
    <h1 class="mb-3">Thematic {{ $thematic->name }} - Images</h1>

    @forelse($thematic->thematicImages()->get() as $image)

        <div class="d-flex mb-3">

            {{-- position --}}
            <div class="fw-bold fs-5 pe-2">#{{ $image->position }}</div>

            {{-- image --}}
            <div class="pe-2" style="width: 200px"><img
                    src="{{ url('storage/upload/thematics/' . $thematic->id . '/' . $image->image_path) }}"
                    class="img-fluid" alt="{{ $image->id }}"></div>

            {{-- actions --}}
            <div class="d-flex flex-column flex-shrink-1 justify-content-between">

                <div>
                    <form method="post"
                          action="{{ route('admin.thematic_image.change_up', ['thematic' => $thematic, 'image' => $image]) }}">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-primary py-0 px-1"><i
                                class="bi bi-arrow-up"></i></button>
                    </form>
                    <form method="post"
                          action="{{ route('admin.thematic_image.change_down', ['thematic' => $thematic, 'image' => $image]) }}">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-primary py-0 px-1"><i
                                class="bi bi-arrow-down"></i></button>
                    </form>
                </div>

                <div>
                    <button data-bs-toggle="modal"
                            data-bs-target="#deleteThematicImage{{ $image->id }}"
                            class="btn btn-sm btn-outline-danger py-0 px-1">
                        <i class="bi bi-trash"></i>
                    </button>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteThematicImage{{ $image->id }}" data-bs-backdrop="static"
                         data-bs-keyboard="false" tabindex="-1"
                         aria-labelledby="deleteThematicImage{{ $image->id }}_label"
                         aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="deleteThematicImage{{ $image->id }}_label">Delete
                                        Carousel Image</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this item?
                                </div>
                                <div class="modal-footer">
                                    <form method="post"
                                          action="{{ route('admin.thematic_image.destroy', ['thematic' => $thematic, 'image' => $image]) }}">
                                        @method('delete')
                                        @csrf
                                        <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abort</a>
                                        <button type="submit" class="btn btn-danger">Ok, Delete it!</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- extra info --}}
            <div class="ps-2">
                <div><span class="fw-bold">Title:</span> {{ $image->title }}</div>
                <div><span class="fw-bold">Description:</span>
                    <p>{{ $image->description }}</p></div>
            </div>

        </div>

    @empty

        <div class="mb-3">No Images Found</div>

    @endforelse

    <div>

        <form name="thematic_image" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-1">
                <label for="thematic_image_image" class="required">Image</label>
                <input type="file" id="thematic_image_image"
                       name="image"
                       required="required"
                       class="form-control"
                       aria-describedby="thematic_image_image_help">
                <div id="thematic_image_image_help" class="help-text">PNG/JPEG and max 5MB allowed</div>
                @error('image')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-1">
                <label for="thematic_image_position" class="required">Position</label>
                <input type="number" id="thematic_image_position" name="position" required="required"
                       class="form-control" value="{{ old('position', $thematic->thematicImages()->count() + 1) }}">
                @error('position')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-1">
                <label for="thematic_image_title" class="required">Title</label>
                <input type="text" id="thematic_image_title" name="title" maxlength="50" class="form-control"
                       value="{{ old('title') }}" required>
                @error('title')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-1">
                <label for="thematic_image_description" class="required">Description</label>
                <input type="text" id="thematic_image_description" name="description" maxlength="150"
                       value="{{ old('description') }}"
                       class="form-control" required>
                @error('description')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success mt-3 mb-5"><i class="bi bi-check fs-4 me-1"></i> Add Image
            </button>
        </form>

    </div>

    <a class="btn btn-outline-primary px-2 py-0" href="{{ route('admin.thematic.index') }}"><i
            class="bi bi-arrow-left fs-4 me-2"></i> back to list</a>
@stop
