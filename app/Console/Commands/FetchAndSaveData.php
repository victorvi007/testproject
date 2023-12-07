<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Repository\PostRepository;
use Illuminate\Support\Facades\Http;

class FetchAndSaveData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate:posts {--userid=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch data from api and update save to database';

    /**
     * Execute the console command.
     */
    public function handle(PostRepository $postRepository)
    {
        $URL = "https://jsonplaceholder.typicode.com/posts";
        $response = Http::get($URL);
        $postData = $response->json();

        $selectPosts = array_splice($postData, 0,5);
        $userId = $this->option('userid');
        foreach($selectPosts as $post){

            $jsonData =  json_encode($post,true);
            $postRepository->createNewPost($userId,$jsonData);
            // return info($jsonData);
        }
        // if($storePost){
        //     return response()->json('Post saved to database');
        // }
        // return response()->json('Something went wrong, Please try again');
    }
}
