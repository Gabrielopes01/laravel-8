<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->segment(2);

        $rules = [
            'title' => "required|min:3|max:160|unique:posts,title,$id,id",   //Pode usar o Rule::unique('posts')->ignore($id)
            'body' => ['nullable', 'min:5', 'max:10000'],
            'photo' => 'required|image'
        ];

        if ($this->method() == 'PUT'){
            $rules['photo'] = 'nullable|image';
        }

        return $rules;
    }

    public function messages() //Este messages é algop adrão do Request que pode ser editado
    {
        return [
            'title.required' => 'O campo Título é obrigatório',
            'title.min' => 'O campo Título deve ter no mínimo 3 caracteres',
            'title.max' => 'O campo Título deve ter no máximo 160 caracteres',
            'title.unique' => 'Este Título ja existe',
            'body.min' => 'O campo Conteúdo deve ter no mínimo 5 caracteres',
            'body.max' => 'O campo Conteúdo deve ter no máximo 10000 caracteres',
            'photo.required' => 'Você precisa adicionar uma imagem',
            'photo.image' => 'O arquivo selecionado não é uma imagem'
        ];
    }
}
