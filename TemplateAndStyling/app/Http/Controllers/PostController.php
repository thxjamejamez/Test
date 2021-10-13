<?php

namespace App\Http\Controllers;

use App\Services\PostService;

class PostController extends Controller
{
    /**
     * @var PostService
     */
    protected $post_service;

    /**
     * @param PostService $post_service
     */
    public function __construct(PostService $post_service)
    {
        $this->post_service = $post_service;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $posts = $this->post_service->getPost();

        return view('MAQEForum.index')->with([
            'posts' => $posts
        ]);
    }
}
