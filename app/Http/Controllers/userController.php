<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

class userController extends Controller {
   //Se aplica a nivel de ruta o a nivel controlador
    public function __construct() {
        $this->middleware('auth');
    }

    public function config() {
        return view('user.config');
    }

    public function update(Request $request) {
        //Conseguir un usuario identificado
        $user = \Auth::user();
        $id = $user->id;
        $validate = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nick' => ['required', 'string', 'max:255', 'unique:users,nick,' . $id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id]
        ]);

        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');

        /* var_dump($id);
          var_dump($email);
          die(); */

        //Asiganr nuevos valores
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        //subir la imagen
        $image_path = $request->file('image_path');
        if ($image_path) {
            $image_path_full = time() . $image_path->getClientOriginalName();
            //Extrae la imagen de la carpeta temporal
            //Guardar en la carpeta storage
            Storage::disk('users')->put($image_path_full, File::get($image_path));
            $user->image = $image_path_full;
        }



        $user->update();
        return redirect()->route('config')
                        ->with(['message' => 'User actualizado con exito.']);
    }

    public function getImage($filename) {
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }
}
