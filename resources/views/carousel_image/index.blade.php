@extends('layouts.admin')

@section('title')
    Carousel Images
@overwrite

@section('content')
    <h1 class="mb-3">Carousel {{ $carousel->name }} - Images</h1>
    <div>Global interval for slides: {{ $carousel->interval }}s</div>

    @forelse($carousel->carouselImages()->get() as $image)

        <div class="d-flex mb-3">

            {{-- position --}}
            <div class="fw-bold fs-5 pe-2">#{{ $image->position }}</div>

            {{-- image --}}
            <div class="pe-2" style="width: 200px"><img
                    src="{{ url('storage/upload/carousels/' . $carousel->id . '/' . $image->image_path) }}"
                    class="img-fluid" alt="{{ $image->id }}"></div>

            {{-- actions --}}
            <div class="d-flex flex-column flex-shrink-1 justify-content-between">

                <div>
                    <form method="post"
                          action="{{ route('admin.carousel_image.change_up', ['carousel' => $carousel, 'image' => $image]) }}">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-primary py-0 px-1"><i
                                    class="bi bi-arrow-up"></i></button>
                    </form>
                    <form method="post"
                          action="{{ route('admin.carousel_image.change_down', ['carousel' => $carousel, 'image' => $image]) }}">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-primary py-0 px-1"><i
                                    class="bi bi-arrow-down"></i></button>
                    </form>
                </div>

                <div>
                    <button data-bs-toggle="modal"
                            data-bs-target="#deleteCarouselImage{{ $image->id }}"
                            class="btn btn-sm btn-outline-danger py-0 px-1">
                        <i class="bi bi-trash"></i>
                    </button>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteCarouselImage{{ $image->id }}" data-bs-backdrop="static"
                         data-bs-keyboard="false" tabindex="-1"
                         aria-labelledby="deleteCarouselImage{{ $image->id }}_label"
                         aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="deleteCarouselImage{{ $image->id }}_label">Delete
                                        Carousel Image</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this item?
                                </div>
                                <div class="modal-footer">
                                    <form method="post"
                                          action="{{ route('admin.carousel_image.destroy', ['carousel' => $carousel, 'image' => $image]) }}">
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
            @if($image->title || $image->description || $image->interval > 0)
                <div class="ps-2">
                    @if($image->interval > 0)
                        <div><span class="fw-bold">Interval:</span> {{ $image->interval }}s</div>
                    @endif
                    @if($image->title)
                        <div><span class="fw-bold">Title:</span> {{ $image->title }}</div>
                    @endif
                    @if($image->description)
                        <div><span class="fw-bold">Description:</span>
                            <p>{{ $image->description }}</p></div>
                    @endif
                </div>
            @endif

        </div>

    @empty

        <div class="mb-3">No Images Found</div>

    @endforelse

    <div>

        <form name="carousel_image" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-1">
                <label for="carousel_image_image" class="required">Image</label>
                <input type="file" id="carousel_image_image"
                       name="image"
                       required="required"
                       class="form-control"
                       aria-describedby="carousel_image_image_help">
                <div id="carousel_image_image_help" class="help-text">PNG/JPEG and max 5MB allowed</div>
                @error('image')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-1">
                <label for="carousel_image_position" class="required">Position</label>
                <input type="number" id="carousel_image_position" name="position" required="required"
                       class="form-control" value="{{ old('position', $carousel->carouselImages()->count() + 1) }}">
                @error('position')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-1">
                <label for="carousel_image_interval">Interval</label>
                <input type="number" id="carousel_image_interval"
                       name="interval"
                       min="0" max="100" class="form-control"
                       aria-describedby="carousel_image_interval_help" value="{{ old('interval', 0) }}">
                <div id="carousel_image_interval_help" class="help-text">Interval in seconds. 0 = use carousel's global
                    interval
                </div>
                @error('interval')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-1">
                <label for="carousel_image_title">Title</label>
                <input type="text" id="carousel_image_title" name="title" maxlength="50" class="form-control" value="{{ old('title') }}">
                @error('title')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-1">
                <label for="carousel_image_description">Description</label>
                <input type="text" id="carousel_image_description" name="description" maxlength="150"
                       value="{{ old('description') }}"
                       class="form-control">
                @error('description')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success mt-3 mb-5"><i class="bi bi-check fs-4 me-1"></i> Add Image
            </button>
        </form>

    </div>

    <a class="btn btn-outline-primary px-2 py-0" href="{{ route('admin.carousel.index') }}"><i
            class="bi bi-arrow-left fs-4 me-2"></i> back to list</a>
@stop
