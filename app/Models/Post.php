<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = ['title', 'body', 'photo'];

    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }  //Sempre usar essa função nos Models das tabelas que vão ao SQLServer

}
