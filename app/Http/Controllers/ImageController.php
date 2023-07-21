<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller {
  //Se aplica a nivel de ruta o a nivel controlador
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function create() {
        return view('image.create');
    }

    public function save(Request $request) {
        $validate = $this->validate($request, [
            'description' => 'required',
            'image_path' => 'required|image'
        ]);
        /*$image_path = $request->$file('image_path');
        $description = $request->input('description');
        $user = Auth::user();
        $image = new Image();
        $image->user_id=$user->id;
        $image->image_path = null;
        $image->description = $description;
        var_dump($user->id);*/
    }
}
