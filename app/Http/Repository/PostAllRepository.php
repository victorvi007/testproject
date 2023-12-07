<?php
namespace App\Http\Repository;

use App\Models\Post;

Class PostAllRepository {
    private $model;

    public function __construct(Post $model){
        $this->model = $model;
    }

    public function createNewPost(){
        return response('hello there');
    }
}
