<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\{Post, Term};
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * @return Response
     */
    public function index()
    {
        $post = Post::publish()->public()->article()->orderBy('updated_at', 'desc')->first();
        $page = Post::publish()->public()->page()->orderBy('updated_at', 'desc')->first();
        $category = Term::category()->orderBy('updated_at', 'desc')->first();

        return response()->view('admin.sitemap.index', [
            'post' => $post,
            'page' => $page,
            'category' => $category
        ])->header('Content-Type', 'text/xml');
    }

    /**
     * @return Response
     */
    public function posts()
    {
        $posts = Post::publish()->public()->article()->languageCurrentSession()->get();
        return response()->view('admin.sitemap.posts', [
            'posts' => $posts,
        ])->header('Content-Type', 'text/xml');
    }

    /**
     * @return Response
     */
    public function pages()
    {
        $pages = Post::publish()->public()->page()->languageCurrentSession()->get();
        return response()->view('admin.sitemap.pages', [
            'pages' => $pages,
        ])->header('Content-Type', 'text/xml');
    }

    /**
     * @return Response
     */
    public function categories()
    {
        $categories = Term::category()->currentLanguage()->get();
        return response()->view('admin.sitemap.categories', [
            'categories' => $categories,
        ])->header('Content-Type', 'text/xml');
    }
}
