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
<input type="text" id="title" name="title" placeholder="Título" value="{{ $post->title ?? old('title') }}" class="form-control">
<br>
<br>
<textarea name="body" id="body" cols="30" rows="4" placeholder="Conteúdo" class="form-control">{{ $post->body ?? old('body') }}</textarea>
<br>
<br>
<input type="file" name="photo" id="photo" class="form-control">
<br>
<br>
<button type="submit" class="btn btn-primary">Salvar</button>
<button type="button" class="btn btn-secondary"><a href="{{ route('posts.index') }}" style="text-decoration: none; color: white">Voltar</a></button>
