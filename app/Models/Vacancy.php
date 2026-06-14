<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vacancy extends Model
{
    use SoftDeletes;

    protected $table = 'vacancies';

    protected $fillable = ['name', 'salary', 'city', 'work_type', 'description', 'requirements', 'advantages', 'application_deadline', 'status'];

    protected $casts = [
        'advantages' => 'array',
        'status' => 'boolean',
        'application_deadline' => 'date',
    ];

    public function applications(): HasMany
    {
        return $this->hasMany(VacancyApplication::class);
    }
}
