<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('salary')->nullable();
            $table->string('city')->nullable();
            $table->string('work_type')->nullable();
            $table->text('description')->nullable();
            $table->text('requirements')->nullable();
            $table->json('advantages')->nullable();
            $table->date('application_deadline')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
