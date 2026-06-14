<?php

namespace App\Http\Controllers;

use App\Services\BannerService;
use App\Services\NewsService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class NewsController extends Controller
{

    private NewsService $newsService;
    private BannerService $bannerService;

    function __construct(NewsService $newsService,BannerService $bannerService)
    {
        $this->newsService = $newsService;
        $this->bannerService = $bannerService;
    }


    public function news(Request $request)
    {
        $banner = $this->bannerService->getByPage('news');
        $newsCategories = $this->newsService->categories();
        return view('web.pages.news.list', compact('banner', 'newsCategories'));
    }


    public function newsDetails(int $id)
    {
        $news = $this->newsService->find($id);
        $featuredNews = $this->newsService->getAll();
        return view('web.pages.news.details', compact('news','featuredNews'));
    }

    public function newsJson(Request $request)
    {
        $params = $request->all();
        $news = $this->newsService->getAll(params: $params);
        return response()->json($news);
    }
}
