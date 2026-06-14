<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StaticController;
use App\Http\Controllers\VacancyController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'home')->name('home');
});

Route::controller(BlogController::class)->group(function () {
    Route::get('/blogs', 'blogs')->name('blog.list');
    Route::get('/blog/{id}', 'blogDetails')->name('blog.details');
    Route::get('/blog-json', 'blogJson')->name('blog.json');
});

Route::controller(NewsController::class)->group(function () {
    Route::get('/news', 'news')->name('news.list');
    Route::get('/news/{id}', 'newsDetails')->name('news.details');
    Route::get('/news-json', 'newsJson')->name('news.json');
});

Route::controller(PartnerController::class)->group(function () {
    Route::get('/partners', 'partners')->name('partners.list');
    Route::post('/partner-application', 'application')->name('partner.application');
});

Route::controller(\App\Http\Controllers\BranchController::class)->group(function () {
    Route::get('/branch', 'branch')->name('branch');
    Route::get('/branch-json', 'branchJson')->name('branch.json');
});

Route::controller(StaticController::class)->group(function () {
    Route::get('/about', 'about')->name('about');
    Route::match(['get', 'post'], '/contact', 'contact')->name('contact');
    Route::get('/faq', 'faqs')->name('faq');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'products')->name('products');
    Route::get('/product/{slug}', 'details')->name('product.details');
    Route::get('/product-json', 'productJson')->name('product.json');
});


Route::controller(VacancyController::class)->group(function () {
    Route::get('/vacancies', 'vacancies')->name('vacancy.list');
    Route::get('/vacancy/{id}', 'details')->name('vacancy.details');
    Route::post('/vacancy-application', 'application')->name('vacancy.application');
});

Route::post('/subscribe', function (\Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'email' => 'required|email|max:255|unique:subscribers,email',
    ]);

    \App\Models\Subscriber::create($validated);

    return response()->json([
        'success' => true,
        'message' => 'Abunəliyiniz uğurla tamamlandı!'
    ]);
})->name('subscribe');

Route::get('/lang/{lang}', function ($lang) {
    $availableLocales = ['az', 'en', 'ru'];
    if (in_array($lang, $availableLocales)) {
        Session::put('locale', $lang);
        App::setLocale($lang);
    }

    return redirect()->back();
})->name('lang.switch');
