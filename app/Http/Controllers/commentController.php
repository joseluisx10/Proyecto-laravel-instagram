<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class commentController extends Controller {

    //
    public function __construct() {
        $this->middleware('auth');
    }

    public function save(Request $request) {

        $validate = $this->validate($request, [
            'image_id' => ['required', 'integer'],
            'content' => ['required', 'string'],
        ]);

        $user = \Auth::user();
        $comment = new Comment();

        $image_id = $request->input('image_id');
        $content = $request->input('content');

        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;
        $comment->save();

        return redirect()->route('image.detail', [
                    'id' => $image_id
                ])->with([
                    'message' => 'Se agrego correctamente el comentario.'
        ]);
    }

    public function delete($id) {
        // Conseguir datos del usuario logueado 
        $user = \Auth::user();

        // Conseguir objeto del comentario
        $comment = Comment::find($id);

        // Comprobar si soy el dueño del comentario o de la publicación
        if ($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)) {
            $comment->delete();

            return redirect()->route('image.detail', ['id' => $comment->image->id])
                            ->with([
                                'message' => 'Comentario eliminado correctamente!!'
            ]);
        } else {
            return redirect()->route('image.detail', ['id' => $comment->image->id])
                            ->with([
                                'message' => 'EL COMENTARIO NO SE HA ELIMINADO!!'
            ]);
        }
    }
}
