<?php
namespace App\Http\Repository;

use App\Models\Post;


class PostRepository {
    private $model;

    public function __construct(Post $model){
     $this->model = $model;
    }

    // Create new post
    public function createNewPost($id,$post){

     return $this->model->create([
         'userId'=>$id,
         'post'=>$post,
     ]);
    }

    // get all post from user
    public function getUserPosts($id){
        return $this->model->findOrFail($id)->get();
    }

    // get all posts
    public function getAllPosts(){
        return $this->model->get();
    }
        // get one post
    public function getOnePost($id){
        return $this->model->where(['id'=>$id])->first();
    }
    // delete posts
    public function deletePost($id){
        return $this->model->where(['id'=>$id])->delete();
    }
    // update posts
    public function updatePost($id,$post){
        return $this->model->where(['id'=>$id])->update([
            'post'=>$post
        ]);
    }
 } ;



