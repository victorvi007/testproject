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
        // Make get request
        $response = Http::get($URL);

        // get response as json
        $postData = $response->json();

        // select first 5 posts
        $selectPosts = array_splice($postData, 0,5);

        // get input userId passed in the command line
        $userId = $this->option('userid');

        // get single post from the 5 posts
        foreach($selectPosts as $post){
            // convert to json formart
            $jsonData =  json_encode($post,true);

            // save to database
            $postRepository->createNewPost($userId,$jsonData);
            // return info($jsonData);
        }
       
    }
}
