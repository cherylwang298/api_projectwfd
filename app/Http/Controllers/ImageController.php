<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    //

    public function getAllImages(){
        $images = Image::all();
        return response()->json($images);
    }
}
