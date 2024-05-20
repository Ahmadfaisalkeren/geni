<?php

namespace App\Services;

use App\Models\Post;

/**
 * Class PostsService.
 */
class PostsService
{
    public function getPosts()
    {
        $posts = Post::all();

        return $posts;
    }

    public function publishedPosts()
    {
        $posts = Post::where('status', '=', 'publish')->orderBy('created_at', 'desc')->get();

        return $posts;
    }

    public function upload($image)
    {
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('images/posts/postDetail', $imageName, 'public');

        return $imagePath;
    }

    public function storePost(array $postData)
    {
        if (isset($postData['image'])) {
            $postData['image'] = $this->storeImage($postData['image']);
        }

        $post = Post::create($postData);

        return $post;
    }

    private function storeImage($image)
    {
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('images/posts', $imageName, 'public');

        return $imagePath;
    }

    public function getPostById(string $postId)
    {
        $post = Post::findOrFail($postId);

        return $post;
    }

    public function updatePost(string $postId, array $postData)
    {
        $post = Post::findOrFail($postId);

        $post->title = $postData['title'] ?? $post->title;
        $post->slug = $postData['slug'] ?? $post->slug;
        $post->author = $postData['author'] ?? $post->author;
        $post->post_date = $postData['post_date'] ?? $post->post_date;
        $post->status = $postData['status'] ?? $post->status;
        $post->content = $postData['content'] ?? $post->content;

        $post->save();

        return $post;
    }

    public function deletePost(string $postId)
    {
        $post = Post::findOrFail($postId);

        $post->delete();

        return $post;
    }
}
