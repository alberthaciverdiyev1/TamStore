<?php

namespace App\Http\Controllers;

use App\Models\VacancyApplication;
use App\Services\BannerService;
use App\Services\VacancyService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class VacancyController extends Controller
{
    private VacancyService $vacancyService;
    private BannerService $bannerService;

    public function __construct(VacancyService $vacancyService, BannerService $bannerService)
    {
        $this->vacancyService = $vacancyService;
        $this->bannerService = $bannerService;
    }

    public function vacancies()
    {
        $banner = $this->bannerService->getByPage('vacancy');
        $vacancies = $this->vacancyService->getAll(10);

        return view('web.pages.vacancy.list', compact('banner', 'vacancies'));
    }

    public function details(int $id)
    {
        $vacancy = $this->vacancyService->getById($id);
        $vacancies = $this->vacancyService->getAll(10);
        $banner = $this->bannerService->getByPage('vacancy');

        return view('web.pages.vacancy.details', compact('vacancy','banner', 'vacancies'));
    }

    public function application(Request $request)
    {
        $validated = $request->validate([
            'vacancy_id' => 'required|exists:vacancies,id',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:10240',
        ]);

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('applications', 'public');
        }

        VacancyApplication::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Müraciətiniz qəbul edildi!',
        ]);
    }
}
