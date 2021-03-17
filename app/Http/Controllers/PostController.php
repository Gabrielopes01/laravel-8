<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\str;

class PostController extends Controller
{
    public function index() {

        $posts = Post::orderBy('id', 'DESC')->paginate(20);   //Pode usar o all() para exibir tudo

        return view('admin.posts.index', compact('posts'));
    }

    public function create() {
        return view('admin.posts.create');
    }

    public function store(StoreUpdatePostRequest $request) {

        $data = $request->all();

        if ($request->photo->isValid()) {

            /*
            $file = $request->photo->store('posts');
            $data['photo'] = $file;
            */

            $nameFile = Str::of($request->title)->slug('-'). '.' .$request->photo->getClientOriginalExtension(); //Esse cliente pega a extesao

            $file = $request->photo->storeAs('posts', $nameFile);
            $data['photo'] = $file;
        }

        Post::create($data);

        return redirect()->route('posts.index')->with('message', 'Post Criado com Sucesso');
    }

    public function show($id) {
        if(!$post = Post::where('id', $id)->first()) {
            return redirect()->route('posts.index');
        }
        //$post = Post::find($id)

        return view('admin.posts.show', compact('post'));
    }

    public function destroy($id) {
        
        if(!$post = Post::find($id)) {
            return redirect()->route("posts.index");
        }

        if (Storage::exists($post->image)) {
            Storage::delete($post->image);
        } else {
            Storage::delete(Post::where('id', $id)->first()->photo);
        }

        $post->delete();

        return redirect()->route("posts.index")->with('message', 'Post Deletado com Sucesso');  //Este with permite criar um flash session com algumas infos
    }

    public function edit($id) {
        if(!$post = Post::find($id)) {
            return redirect()->back();
        }

        return view('admin.posts.edit', compact('post'));
    }

    public function update(StoreUpdatePostRequest $request, $id) {
        if(!$post = Post::find($id)) {
            return redirect()->back();
        }

        $data = $request->all();

        if ($request->photo->isValid()) {

            if (Storage::exists($post->image)) {
                Storage::delete($post->image);
            } else {
                Storage::delete(Post::where('id', $id)->first()->photo);
            }

            $nameFile = Str::of($request->title)->slug('-'). '.' .$request->photo->getClientOriginalExtension(); //Esse cliente pega a extesao

            $file = $request->photo->storeAs('posts', $nameFile);
            $data['photo'] = $file;
        }

        $post->update($data);

        return redirect()->route('posts.index')->with('message', 'Post Atualizado com Sucesso');
    }

    public function search(Request $request) {

        $filters = $request->except('_token');

        $posts = Post::where('title', '=', "%$request->search%")
                        ->orWhere('body', 'LIKE', "%$request->search%")
                        ->paginate(20);
        
        return view('admin.posts.index', compact('posts', 'filters'));
    }
}
