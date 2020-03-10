<?php

namespace App\Http\Controllers;

use App\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{
    /**
     * Store image in a database.
     * 
     * @param $request Request
     * @return response
     */
    public function store(Request $request) 
    {   
        $attributes = $request->validate([
            'owner_id' => 'required',
            'owner_type' => 'required',
            'image' => 'required|image|max:1024'
        ]);

        $className = 'App\\'.ucfirst($attributes['owner_type']);

        $images = Image::where('owner_id', $attributes['owner_id'])->where('owner_type', $className)->get();

        if($images) 
        {
            foreach($images as $image)
            {
                $this->destroy($image);
            }
        }

        $image = Image::create([
            'owner_id' => $attributes['owner_id'],
            'owner_type' => $className,
            'url' => '/'.request()->file('image')->store('images', 's3')
        ]);
            
        return response()->json($image, 200);
    }

    /**
     * Remove a file from aws s3 and a record from database.
     * 
     * @return response
     */
    public function destroy(Image $image) 
    {
        Storage::disk('s3')->delete($image->url);
        $image->delete();
    }
}
