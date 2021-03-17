@if ($errors->any())
    <div>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>    
        @endforeach
        </ul>
    </div>
@endif


@csrf
<input type="text" id="title" name="title" placeholder="Título" value="{{ $post->title ?? old('title') }}">
<br>
<br>
<textarea name="body" id="body" cols="30" rows="4" placeholder="Conteúdo">{{ $post->body ?? old('body') }}</textarea>
<br>
<br>
<input type="file" name="photo" id="photo">
<br>
<br>
<button type="submit">Salvar</button>
<button type="button"><a href="{{ route('posts.index') }}" style="text-decoration: none">Voltar</a></button>
