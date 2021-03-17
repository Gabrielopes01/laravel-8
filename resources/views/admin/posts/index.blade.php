@extends('admin.layouts.app')

@section('title', 'Listagem')

@section('content')
<button><a href="{{ route('posts.create') }}" style="text-decoration: none">Criar novo Post</a></button>
<hr>
<h1>Posts</h1>

<ul>
    @foreach ($posts as $post)
        <li>{{$post->title}}, {{$post->body}}</li>
    @endforeach
</ul>

@if (session('message'))
    <p>{{ session('message') }}</p>
@endif

<form action="{{ route('posts.search') }}" method="post">
    @csrf
    <input type="text" name="search" placeholder="Filtrar:">
    <button type="submit">Filtrar</button>
</form>

<table border=1>
    <thead>
        <tr>
            <th>Id</th>
            <th>Imagem</th>
            <th>Título</th>
            <th>Corpo</th>
            <th>Caminho</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                @if (file_exists('storage/'.$post->photo))
                    <td><a href="{{ url("storage/{$post->photo}") }}"><img src="{{ url("storage/{$post->photo}") }}" alt="{{ $post->title }}" style="max-width: 100px; max-height: 120px"></a></td>
                @else
                    <td><a href="storage/posts/default.jpg"><img src="storage/posts/default.jpg" alt="{{ $post->title }}" style="max-width: 100px; max-height: 120px"></a></td>
                @endif
                <td>{{ $post->title }}</td>
                <td>{{ $post->body }}</td>
                <td>{{ $post->photo }}</td>
                <td><a href="/posts/{{ $post->id }}">Detalhes</a> <a href="{{ route('posts.edit', $post->id) }}">Editar</a></td>
            </tr>
        @endforeach
    </tbody>
</table>

<hr>

@if (isset($filters))
{{ $posts->appends($filters)->links() }} 
@else
{{ $posts->links() }}    
@endif
 
@endsection