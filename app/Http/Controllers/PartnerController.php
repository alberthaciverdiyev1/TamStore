<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Services\BannerService;
use App\Services\PartnerService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PartnerController extends Controller
{

    private PartnerService $partnerService;
    private BannerService $bannerService;

    function __construct(PartnerService $partnerService, BannerService $bannerService)
    {
        $this->partnerService = $partnerService;
        $this->bannerService = $bannerService;
    }

    public function partners(Request $request){
        $banner = $this->bannerService->getByPage('partner');
        $partners = $this->partnerService->getAll($request);
        return view('web.pages.partner.list', compact('banner', 'partners'));
    }

    public function application(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'company_name' => 'nullable|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:10240',
        ]);

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('applications', 'public');
        }

        $validated['type'] = 'partner';

        Contact::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Müraciətiniz qəbul edildi!'
        ]);
    }
}
