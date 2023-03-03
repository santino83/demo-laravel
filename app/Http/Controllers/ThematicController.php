<?php

namespace App\Http\Controllers;

use App\Http\Requests\ThematicRequest;
use App\Models\Thematic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ThematicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $thematics = Thematic::all();

        return view('thematic.index')->with(['thematics' => $thematics]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $thematic = new Thematic();

        return view('thematic.create')->with(['thematic' => $thematic]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ThematicRequest $request): ?RedirectResponse
    {
        $thematic = Thematic::create($request->safe()->all());

        return redirect(route('admin.thematic.index'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Thematic $thematic)
    {
        return view('thematic.edit')->with(['thematic' => $thematic]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ThematicRequest $request, Thematic $thematic)
    {
        $thematic->update($request->safe()->all());

        return redirect(route('admin.thematic.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Thematic $thematic)
    {
        $thematic->delete();

        try {
            Storage::deleteDirectory('public/upload/thematics/' . $thematic->id);
        } catch (\Exception $ex) {
            // do nothing
        }

        return redirect(route('admin.thematic.index'));
    }
}
