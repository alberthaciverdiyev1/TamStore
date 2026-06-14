<?php

namespace App\Http\Controllers;

use App\Services\BannerService;
use App\Services\BlogService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BlogController extends Controller
{
    private BlogService $blogService;
    private BannerService $bannerService;

    function __construct(BlogService $blogService, BannerService $bannerService)
    {
        $this->bannerService = $bannerService;
        $this->blogService = $blogService;
    }

    public function blogs(Request $request)
    {
        $banner = $this->bannerService->getByPage('blog');
        $blogCategories = $this->blogService->categories();
        return view('web.pages.blog.list', compact('banner', 'blogCategories'));
    }


    public function blogDetails(int $id)
    {
        $blog = $this->blogService->find($id);
        $featuredBlogs = $this->blogService->getAll();
        return view('web.pages.blog.details', compact('blog','featuredBlogs'));
    }

    public function blogJson(Request $request)
    {
        $params = $request->all();
        $blogs = $this->blogService->getAll(params: $params);
        return response()->json($blogs);
    }

}
