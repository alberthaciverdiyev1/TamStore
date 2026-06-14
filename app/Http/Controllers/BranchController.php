<?php

namespace App\Http\Controllers;

use App\Services\BannerService;
use App\Services\BranchService;
use App\Services\GalleryService;
use App\Services\PartnerService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BranchController extends Controller
{
    private BannerService $bannerService;
    private BranchService $branchService;

    function __construct(BannerService $bannerService, BranchService $branchService)
    {
        $this->bannerService = $bannerService;
        $this->branchService = $branchService;

    }

    public function branch()
    {
        $banner = $this->bannerService->getByPage('branch');
        $branches = $this->branchService->getAll();

        return view('web.pages.branch', compact('banner', 'branches'));
    }

    public function branchJson(Request $request)
    {
        $params = $request->all();
        $branches = $this->branchService->getAll(params: $params);
        return response()->json($branches);
    }
}
