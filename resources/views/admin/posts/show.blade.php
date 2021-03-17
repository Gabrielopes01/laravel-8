@extends('admin.layouts.app')

@section('title', "Post $post->id")
    
@section('content')
<h1>Detalhes do Post {{ $post->id }} </h1>

<ul>
    <li>Título: <strong>{{ $post->title }}</strong></li>
    <li>Conteúdo: <strong>{{ $post->body }}</strong></li>
</ul>

<form action="{{ route("posts.destroy", $post->id) }}" method="post">
    @method('delete')
    @csrf
    <button type="submit">Deletar o Post {{ $post->id }}</button>
</form>
@endsection