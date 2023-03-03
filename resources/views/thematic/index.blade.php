@extends('layouts.admin')

@section('title')
    Admin Thematics
@overwrite

@section('content')

    <h1>Thematics</h1>

    <table class="table table-hover table-striped align-middle">
        <thead>
        <tr>
            <th scope="col" class="w-auto">#</th>
            <th scope="col" class="w-25">Name</th>
            <th scope="col" class="w-25">Page</th>
            <th scope="col" class="w-auto">Position</th>
            <th scope="col" class="w-auto">Images</th>
            <th scope="col" class="w-auto">Updated At</th>
            <th scope="col" class="w-auto">Created At</th>
            <th scope="col" class="w-auto">Actions</th>
        </tr>
        </thead>
        <tbody class="table-group-divider">
        @forelse($thematics as $thematic)
            <tr>
                <th scope="row">{{ $thematic->id }}</th>
                <td>{{ $thematic->name }}</td>
                <td>{{ $thematic->page }}</td>
                <td>{{ $thematic->position }}</td>
                <td>{{ $thematic->thematicImages()->count() }}</td>
                <td>{{ $thematic->updated_at ? $thematic->updated_at->format('Y-m-d H:i:s') : '' }}</td>
                <td>{{ $thematic->created_at ? $thematic->created_at->format('Y-m-d H:i:s') : '' }}</td>
                <td>


                    <div class="btn-group">

                        <a class="btn btn-primary btn-sm px-3"
                           href="{{ route('admin.thematic_image.index', $thematic) }}"
                           data-bs-placement="bottom" data-bs-toggle="tooltip" data-bs-title="Manage Images">
                            <i class="bi bi-image fs-5"></i>
                        </a>

                        <button class="btn btn-outline-secondary py-0" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                            ...
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('admin.thematic.edit', $thematic) }}"><i
                                    class="bi bi-pencil me-2"></i> edit</a>
                            <div class="dropdown-divider"></div>
                            <button class="dropdown-item" data-bs-toggle="modal"
                                    data-bs-target="#deleteThematic{{ $thematic->id }}"><i class="bi bi-trash me-2"></i>
                                Delete
                            </button>
                        </div>

                    </div>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteThematic{{ $thematic->id }}" data-bs-backdrop="static"
                         data-bs-keyboard="false" tabindex="-1"
                         aria-labelledby="deleteThematic{{ $thematic->id }}_label"
                         aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="deleteThematic{{ $thematic->id }}_label">Delete
                                        Thematic {{ $thematic->name }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this item?
                                </div>
                                <div class="modal-footer">
                                    <form method="POST"
                                          action="{{ route('admin.thematic.destroy', $thematic) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abort</a>
                                        <button type="submit" class="btn btn-danger">Ok, Delete it!</button>
                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>

                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8">no records found</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <a class="btn btn-success float-end" href="{{ route('admin.thematic.create') }}">
        <i class="bi bi-plus fs-5"></i>
        Create new
    </a>

@stop
