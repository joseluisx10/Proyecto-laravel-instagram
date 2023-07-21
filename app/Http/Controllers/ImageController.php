<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

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

        $image_path = $request->file('image_path');
        $description = $request->input('description');
        $user = \Auth::user();
        $image = new Image();
        $image->user_id = $user->id;
        $image->image_path = null;
        $image->descripcion = $description;
        if ($image_path) {
            $image_path_full = time() . $image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_full, File::get($image_path));
            $image->image_path = $image_path_full;
        }
        //var_dump($image);
        $image->save();
        return redirect()->route('home')
                        ->with(['message' => 'La foto ha sido subido con exito.']);
    }

    public function getImage($filename) {
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }
}
