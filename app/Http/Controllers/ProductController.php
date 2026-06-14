<?php

namespace App\Http\Controllers;

use App\Services\BannerService;
use App\Services\BrandService;
use App\Services\FilterService;
use App\Services\PartnerService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    private PartnerService $partnerService;
    private BannerService $bannerService;
    private BrandService $brandService;
    private FilterService $filterService;
    private ProductService $productService;

    function __construct(PartnerService $partnerService, BannerService $bannerService, BrandService $brandService, FilterService $filterService, ProductService $productService)
    {
        $this->partnerService = $partnerService;
        $this->brandService = $brandService;
        $this->bannerService = $bannerService;
        $this->filterService = $filterService;
        $this->productService = $productService;
    }

    public function products(Request $request)
    {
        $banner = $this->bannerService->getByPage('product');
        $brands = $this->brandService->getAll();
        $partners = $this->partnerService->getAll();
        $filters = $this->filterService->getAll();
        $products = $this->productService->getAll($request);

        return view('web.pages.product.list', compact('banner', 'partners', 'brands', 'filters', 'products'));
    }


    public function details($slug)
    {
        $product = $this->productService->details($slug);
        if (!$product) {
            return redirect()->route('products');
        }
//dd($product);
        $similarRequest = new Request([
            'category_id' => $product->category_id
        ]);

        $similar = $this->productService->getAll($similarRequest);

        return view('web.pages.product.details',compact('product','similar'));
    }

    public function productJson(Request $request)
    {

    }
}
