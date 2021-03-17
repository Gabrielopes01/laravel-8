@extends('admin.layouts.app')

@section('title', 'Criar')

<div class="row">
        @section('content')
        <br>
        <br>
        <br>
        <div class="col col-md-4 offset-md-4">
            <h1>Cadastrar Novo Post</h1>
                
            <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                @include('admin.posts.partials.form')
            </form>
        </div>
        @endsection
</div>
