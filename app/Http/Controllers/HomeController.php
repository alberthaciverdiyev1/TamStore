<?php

namespace App\Http\Controllers;

use App\Services\BannerService;
use App\Services\BlogService;
use App\Services\CategoryService;
use App\Services\GalleryService;
use App\Services\HomeCardService;
use App\Services\PartnerService;
use App\Services\PopupService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    private BannerService $bannerService;
    private PartnerService $partnerService;
    private HomeCardService $homeCardService;
    private CategoryService $categoryService;
    private BlogService $blogService;
    private GalleryService $galleryService;
    private PopupService $popupService;

    function __construct(BannerService $bannerService, PartnerService $partnerService, HomeCardService $homeCardService, CategoryService $categoryService, BlogService $blogService, GalleryService $galleryService, PopupService $popupService)
    {
        $this->bannerService = $bannerService;
        $this->partnerService = $partnerService;
        $this->homeCardService = $homeCardService;
        $this->categoryService = $categoryService;
        $this->blogService = $blogService;
        $this->galleryService = $galleryService;
        $this->popupService = $popupService;
    }

    public function home()
    {
        $banners = $this->bannerService->getByPage('home');
        $partners = $this->partnerService->getAll();
        $homeCards = $this->homeCardService->getAll();
        $categories = $this->categoryService->getFeatured();
        $blogs = $this->blogService->getAll();
        $galleries = $this->galleryService->getAll();
        $popup = $this->popupService->getActive();
        return view('web.pages.home', compact('banners', 'partners', 'homeCards', 'categories', 'blogs', 'galleries', 'popup'));
    }


}
