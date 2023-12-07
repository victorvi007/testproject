<?php
namespace App\Http\Repository;

use App\Models\Post;


class PostRepository {
    private $model;

    public function __construct(Post $model){
     $this->model = $model;
    }
    public function createNewPost($id,$post){
    //  return response($this->model);
     return $this->model->create([
         'userId'=>$id,
         'post'=>$post,
     ]);
    }

    public function getUserPosts($id){
        return $this->model->findOrFail($id)->get();
    }


    public function getAllPosts(){
        return $this->model->get();
    }
    public function getOnePost($id){
        return $this->model->where(['id'=>$id])->first();
    }

    public function deletePost($id){
        return $this->model->where(['id'=>$id])->delete();
    }
    public function updatePost($id,$post){
        return $this->model->where(['id'=>$id])->update([
            'post'=>$post
        ]);
    }
 } ;



