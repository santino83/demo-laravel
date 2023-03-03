<?php

namespace App\Http\Controllers;

use App\Http\Requests\ThematicImageRequest;
use App\Models\Thematic;
use App\Models\ThematicImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ThematicImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Thematic $thematic): View
    {
        return view('thematic_image.index')->with(['thematic' => $thematic]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Thematic $thematic, ThematicImageRequest $request)
    {
        $thematicImage = new ThematicImage($request->except(['image']));

        try{

            $file = $request->file('image');
            $name = 'image-' . uniqid() .'.' . $file->guessExtension();

            $file->storeAs('upload/thematics/'.$thematic->id, $name, 'public');

            $thematicImage->image_path = $name;

            $thematicImage->thematic_id = $thematic->id;
            $thematicImage->saveInPosition();

            return redirect()->back();

        }catch (\Exception $ex){

            return redirect()->back()->withErrors(['image' => 'Cannot Upload image'])->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Thematic $thematic, int $thematicImageId): RedirectResponse
    {
        $thematicImage = ThematicImage::with('thematic')->find($thematicImageId);

        if($thematicImage->thematic->id !== $thematic->id ){
            return redirect()->back();
        }

        $thematicImage->removeFromPosition();

        try{
            Storage::delete('public/upload/thematics/'.$thematic->id.'/'.$thematicImage->image_path);
        }catch (\Exception $ex){
            //do nothing
        }

        return redirect()->back();
    }

    public function moveUp(Thematic $thematic, int $thematicImageId): RedirectResponse
    {
        /**@var \App\Models\ThematicImage $thematicImage */
        $thematicImage = ThematicImage::with('thematic')->find($thematicImageId);

        if($thematicImage->thematic->id !== $thematic->id ){
            return redirect()->back();
        }

        $thematicImage->moveUp();

        return redirect()->back();
    }

    public function moveDown(Thematic $thematic, int $thematicImageId): RedirectResponse
    {
        /**@var \App\Models\ThematicImage $thematicImage */
        $thematicImage = ThematicImage::with('thematic')->find($thematicImageId);

        if($thematicImage->thematic->id !== $thematic->id ){
            return redirect()->back();
        }

        $thematicImage->moveDown();

        return redirect()->back();
    }
}
