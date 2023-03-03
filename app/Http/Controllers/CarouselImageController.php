<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarouselImageRequest;
use App\Http\Requests\UpdateCarouselImageRequest;
use App\Models\Carousel;
use App\Models\CarouselImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CarouselImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Carousel $carousel): View
    {
        return view('carousel_image.index')->with(['carousel' => $carousel]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Carousel $carousel, CarouselImageRequest $request)
    {
        $carouselImage = new CarouselImage($request->except(['image']));

        try{

            $file = $request->file('image');
            $name = 'image-' . uniqid() .'.' . $file->guessExtension();

            $file->storeAs('upload/carousels/'.$carousel->id, $name, 'public');

            $carouselImage->image_path = $name;

            $carouselImage->carousel_id = $carousel->id;
            $carouselImage->saveInPosition();

            return redirect()->back();

        }catch (\Exception $ex){

            return redirect()->back()->withErrors(['image' => 'Cannot Upload image'])->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carousel $carousel, int $carouselImageId): RedirectResponse
    {
        $carouselImage = CarouselImage::with('carousel')->find($carouselImageId);

        if($carouselImage->carousel->id !== $carousel->id ){
            return redirect()->back();
        }

        $carouselImage->removeFromPosition();

        try{
            Storage::delete('public/upload/carousels/'.$carousel->id.'/'.$carouselImage->image_path);
        }catch (\Exception $ex){
            //do nothing
        }

        return redirect()->back();
    }

    public function moveUp(Carousel $carousel, int $carouselImageId): RedirectResponse
    {
        /**@var \App\Models\CarouselImage $carouselImage */
        $carouselImage = CarouselImage::with('carousel')->find($carouselImageId);

        if($carouselImage->carousel->id !== $carousel->id ){
            return redirect()->back();
        }

        $carouselImage->moveUp();

        return redirect()->back();
    }

    public function moveDown(Carousel $carousel, int $carouselImageId): RedirectResponse
    {
        /**@var \App\Models\CarouselImage $carouselImage */
        $carouselImage = CarouselImage::with('carousel')->find($carouselImageId);

        if($carouselImage->carousel->id !== $carousel->id ){
            return redirect()->back();
        }

        $carouselImage->moveDown();

        return redirect()->back();
    }

}
