<h1>Cadastrar Novo Post</h1>

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
<form action="{{ route('posts.store') }}" method="post">
    @csrf
    <input type="text" id="title" name="title" placeholder="Título" value="{{ old('title') }}">
    <br>
    <br>
    <textarea name="body" id="body" cols="30" rows="4" placeholder="Conteúdo">{{ old('body') }}</textarea>
    <br>
    <br>
    <button type="submit">Enviar</button>
</form>