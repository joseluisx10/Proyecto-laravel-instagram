@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if(session('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
            @endif
            <div class="card mb-3 bg-light">
                <div class="card-header d-flex align-items-center">
                    @if($image->user->image)
                    <div class="me-3">
                        <img src="{{route('user.avatar',['filename'=>Auth::user()->image])}}" class="rounded-5" style="width: 40px; height: 40px"/>
                    </div>
                    @endif
                    <div class="lh-lg fw-bold">
                        {{$image->user->name.' '.$image->user->surname}}
                        <span class="text-secondary">{{'  | @'.$image->user->nick}}</span>
                    </div>
                </div>
                <div class="card-body p-0">
                    <img src="{{route('image.file', ['filename'=>$image->image_path])}}" class="image-fluid w-100" height="350" alt="imagen"/>
                </div>
                <div class="px-4 py-1">
                    <span class="text-secondary fw-bold">{{'@'.$image->user->nick}}</span>
                    <span class="text-secondary fw-bold">{{' | Se unió: '.\FormatTime::LongTimeFilter($image->created_at)}}</span>
                    <p class="mb-0">{{$image->descripcion}}</p>
                </div>
                <div class="d-flex px-4">
                    <a href=""><i class="bi bi-suit-heart text-danger fs-4 me-2"></i></a>
                    <p class="mb-0"><a href="" class="btn btn-sm btn-warning">Comentarios ({{count($image->comments)}})</a></p>                    
                </div>
                <div class="clearfix"></div>
                <div class="px-4">

                    <span class="h2">Comentarios ({{count($image->comments)}})</span>
                    <hr>

                    <form method="POST" action="{{ route('comment.save') }}">
                        @csrf

                        <input type="hidden" name="image_id" value="{{$image->id}}" />
                        <p>
                            <textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content"></textarea>
                            @if($errors->has('content'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('content') }}</strong>
                            </span>
                            @endif
                        </p>
                        <button type="submit" class="btn btn-success">
                            Enviar
                        </button>
                    </form>
                    <hr>
                    @foreach($image->comments as $comment)
                        <span class="text-secondary fw-bold">{{'@'.$comment->user->nick}}</span>
                        <span class="text-secondary fw-bold">{{' | '.\FormatTime::LongTimeFilter($comment->created_at)}}</span>
                        <p class="mb-0">{{$comment->content}}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endsection


