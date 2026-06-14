<?php

namespace App\Services;

use App\Models\Vacancy;

class VacancyService
{
    public function getAll(int $perPage = null, string $locale = null)
    {
        $locale ??= app()->getLocale();

        $query = Vacancy::where('status', true)
//            ->where(function ($q) {
//                $q->whereNull('application_deadline')
//                    ->orWhere('application_deadline', '>=', now());
//            })
            ->orderBy('created_at', 'desc');

        if ($perPage) {
            return $query->paginate($perPage)
                ->through(fn (Vacancy $vacancy) => $this->mapVacancy($vacancy, $locale));
        }

        return $query->get()
            ->map(fn (Vacancy $vacancy) => $this->mapVacancy($vacancy, $locale));
    }

    public function getById(int $id, string $locale = null)
    {
        $locale ??= app()->getLocale();

        $vacancy = Vacancy::where('status', true)
            ->where('id', $id)
            ->firstOrFail();

        return $this->mapVacancy($vacancy, $locale);
    }

    private function mapVacancy(Vacancy $vacancy, string $locale): object
    {
        $workTypes = [
            'full_time' => ['az' => 'Tam ştat', 'en' => 'Full Time', 'ru' => 'Полный день'],
            'part_time' => ['az' => 'Yarım ştat', 'en' => 'Part Time', 'ru' => 'Неполный день'],
            'remote' => ['az' => 'Remote', 'en' => 'Remote', 'ru' => 'Удалённо'],
            'hybrid' => ['az' => 'Hybrid', 'en' => 'Hybrid', 'ru' => 'Гибрид'],
            'freelance' => ['az' => 'Frilans', 'en' => 'Freelance', 'ru' => 'Фриланс'],
        ];

        $workType = $vacancy->work_type;
        $workTypeLabel = $workTypes[$workType][$locale] ?? $workTypes[$workType]['az'] ?? $workType;

        return (object) [
            'id' => $vacancy->id,
            'name' => $vacancy->name,
            'salary' => $vacancy->salary,
            'city' => $vacancy->city,
            'work_type' => $vacancy->work_type,
            'work_type_label' => $workTypeLabel,
            'description' => $vacancy->description,
            'requirements' => $vacancy->requirements,
            'advantages' => $vacancy->advantages,
            'application_deadline' => $vacancy->application_deadline?->format('Y-m-d'),
            'created_at' => $vacancy->created_at?->format('Y-m-d'),
        ];
    }
}
