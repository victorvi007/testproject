<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Http;
use App\Http\Repository\PostRepository;
use App\Http\Repository\UserRepository;



class SiteController extends Controller
{
    // get all user post
    public function getUserPosts(PostRepository $postRepository){

        $id = auth()->user()->id;

        $allPost = $postRepository->getUserPosts($id);

        return response()->json($allPost[0]->user);


    }
    // get All users
    public function getAllUsers(UserRepository $userRepository){
        $users = $userRepository->getAllUsers();
        return response()->json($users[0]->posts);
    }

        // get all Posts
    public function getAllPosts(PostRepository $postRepository){
        $allPost = $postRepository->getAllPosts();
        return response()->json($allPost);
    }
    // get one Post
    public function getOnePost($id,PostRepository $postRepository){
        $onePost = $postRepository->getOnePost($id);
        return response()->json($onePost);
    }

    // delete Post
    public function deletePost($id,PostRepository $postRepository){
        $getPost = $postRepository->deletePost($id);
        return response()->json('Post deleted successfully');
    }

        // Update Post
    public function updatePost($id,PostRequest $postRequest,PostRepository $postRepository){

        $shape = [
            'userId'=> $id,
            'id'=>$postRequest->id,
            'title'=>$postRequest->title,
            'body'=>$postRequest->body,
        ];

        $obj = (object) $shape;


        $jsonData =  json_encode($obj,true);
        $update = $postRepository->updatePost($id,$jsonData);
        if($update){

            return response()->json('Post updated successfully');
        }

        return response()->json('try again, something went wrong');
    }
}
