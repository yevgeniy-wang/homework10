<?php

namespace Hillel\Homework10\Controller;


use Hillel\Homework10\Model\Category;
use Hillel\Homework10\Model\Post;
use Hillel\Homework10\Model\Tag;
use Illuminate\Http\RedirectResponse;

class PostController
{
    public function list()
    {
        $posts = Post::all();

        return view('pages/posts/table', compact('posts'));
    }

    public function create()
    {
        $post = new Post();
        $categories = Category::all();
        $tags = Tag::all();

        return view('pages/posts/form', compact('post', 'categories', 'tags'));
    }

    public function store()
    {
        $data = request()->all();


        $validator = validator()->make($data, [
            'title'    => ['required', 'min:5', 'unique:posts,title'],
            'slug'     => ['required', 'min:5', 'unique:posts,slug'],
            'body'     => ['required', 'min:5'],
            'category' => ['required', 'exists:categories,id'],
            'tags'     => ['required', 'exists:tags,id'],
        ]);

        $error = $validator->errors();

        if (count($error) > 0) {
            $_SESSION['data'] = $data;
            $_SESSION['errors'] = $error->toArray();

            return new RedirectResponse($_SERVER['HTTP_REFERER']);
        }

        $post = new Post();
        $post->title = $data['title'];
        $post->slug = $data['slug'];
        $post->body = $data['body'];
        $post->category_id = $data['category'];
        $post->save();

        $post->tags()->attach($data['tags']);

        $_SESSION['message'] = [
            'status' => 'success',
            'text'   => "post \"{$data['title']}\" successfully saved"
        ];

        return new RedirectResponse('/posts');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $tags = Tag::all();
        unset($_SESSION['db']);

        $_SESSION['db']['category'] = $_SESSION['data']['category'] ?? $post->category_id;
        $_SESSION['db']['tags'] = $_SESSION['data']['tags'] ?? $post->tags->pluck('id')->toArray();


        return view('pages/posts/form', compact('post', 'categories', 'tags'));
    }

    public function update($id)
    {
        $post = Post::find($id);

        $data = request()->all();

        $validator = validator()->make($data, [
            'title'    => ['required', 'min:5', 'unique:posts,title,' . $id],
            'slug'     => ['required', 'min:5', 'unique:posts,slug,' . $id],
            'body'     => ['required', 'min:5'],
            'category' => ['required', 'exists:categories,id'],
            'tags'     => ['required', 'exists:tags,id'],
        ]);

        $error = $validator->errors();

        if (count($error) > 0) {
            $_SESSION['data'] = $data;
            $_SESSION['errors'] = $error->toArray();

            return new RedirectResponse($_SERVER['HTTP_REFERER']);
        }

        $post->title = $data['title'];
        $post->slug = $data['slug'];
        $post->body = $data['body'];
        $post->category_id = $data['category'];
        $post->save();

        $post->tags()->detach();
        $post->tags()->attach($data['tags']);

        $_SESSION['message'] = [
            'status' => 'success',
            'text'   => "post \"{$data['title']}\" successfully saved"
        ];

        return new RedirectResponse('/posts');
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        $post->tags()->detach();
        $post->delete();

        $_SESSION['message'] = [
            'status' => 'success',
            'text'   => "post \"{$post->title}\" successfully deleted"
        ];

        return new RedirectResponse('/posts');
    }
}