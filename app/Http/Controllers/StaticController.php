<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Services\BannerService;
use App\Services\BranchService;
use App\Services\FaqService;
use App\Services\GalleryService;
use App\Services\PartnerService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StaticController extends Controller
{

    private PartnerService $partnerService;
    private BannerService $bannerService;
    private FaqService $faqService;
    private GalleryService $galleryService;


    function __construct(PartnerService $partnerService, BannerService $bannerService, GalleryService $galleryService, BranchService $branchService, FaqService $faqService)
    {
        $this->partnerService = $partnerService;
        $this->bannerService = $bannerService;
        $this->branchService = $branchService;
        $this->galleryService = $galleryService;
        $this->faqService = $faqService;

    }

    public function about()
    {
        $banner = $this->bannerService->getByPage('about');
        $partners = $this->partnerService->getAll();
        $galleries = $this->galleryService->getAll();

        return view('web.pages.about', compact('banner', 'partners', 'galleries'));
    }


    public function faqs()
    {
        $faqs = $this->faqService->getAll();

        return view('web.pages.faq', compact('faqs'));
    }

    public function contact(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'full_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'subject' => 'required|string|max:255',
                'message' => 'required|string|min:3',
            ]);

            $validated['type'] = 'contact';

            Contact::create($validated);

            return response()->json([
                'success' => true,
                'message' => __("Mesajınız uğurla göndərildi!")
            ], 200);
        }

        $banner = $this->bannerService->getByPage('contact');
        $branches = $this->branchService->getAll();

        return view('web.pages.contact', compact('banner', 'branches'));
    }

}
