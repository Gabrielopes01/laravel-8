@extends('admin.layouts.app')

@section('title', 'Editar')

@section('content')
<h1>Editar Post {{ $post->id }}</h1>



<form action="{{ route('posts.update', $post->id) }}" method="post">
    @method('put')
    @include('admin.posts.partials.form')
</form>
@endsection