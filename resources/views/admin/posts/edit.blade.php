<h1>Editar Post {{ $post->id }}</h1>

@if ($errors->any())
    <div>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>    
        @endforeach
        </ul>
    </div>
@else
    
@endif
<form action="{{ route('posts.update', $post->id) }}" method="post">
    @method('put')
    @csrf
    <input type="text" id="title" name="title" placeholder="Título" value="{{ $post->title }}">
    <br>
    <br>
    <textarea name="body" id="body" cols="30" rows="4" placeholder="Conteúdo">{{ $post->body }}</textarea>
    <br>
    <br>
    <button type="submit">Salvar</button>
</form>