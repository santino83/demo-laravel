<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarouselRequest;
use App\Models\Carousel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $carousels = Carousel::all();

        return view('carousel.index')->with(['carousels' => $carousels]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $carousel = new Carousel();

        return view('carousel.create')->with(['carousel' => $carousel]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarouselRequest $request): ?RedirectResponse
    {
        $carousel = Carousel::create($request->safe()->all());

        return redirect(route('admin.carousel.index'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carousel $carousel)
    {
        return view('carousel.edit')->with(['carousel' => $carousel]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarouselRequest $request, Carousel $carousel)
    {
        $carousel->update($request->safe()->all());

        return redirect(route('admin.carousel.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carousel $carousel)
    {
        $carousel->delete();

        try{
            Storage::deleteDirectory('public/upload/carousels/'.$carousel->id);
        }catch (\Exception $ex){
            // do nothing
        }

        return redirect(route('admin.carousel.index'));
    }
}
