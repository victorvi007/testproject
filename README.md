Test Project Documentation


Develop a Custom Artisan Command

To initiate the process, I created a custom artisan command named populate:posts. This command would serve as a tool for fetching and storing posts from an external API. The command also included an option to specify the user ID for whom the posts would be fetched.


Develop a Custom Artisan Command
To initiate the process, I created a custom artisan command named populate:posts. This command would serve as a tool for fetching and storing posts from an external API. The command also included an option to specify the user ID for whom the posts would be fetched.

Save Posts in JSON Format
The selected posts were then serialized in JSON format and saved in the user's external posts table. This involved creating a model for external posts and establishing the necessary relationships.

Save Post to Database
The json formatted data is then saved to the database. The selected posts were then serialized in JSON format and saved in the user's external posts table. This involved creating a model for external posts and establishing the necessary relationships.


Accessing Posts 
## '/api/all-post'
With the implementation complete, users can now access all posts by making a GET request to the '/api/all-post' endpoint. The response will contain an array of posts, each with its relevant details.
