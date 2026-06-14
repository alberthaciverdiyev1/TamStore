<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('first_title')->nullable();
            $table->string('second_title')->nullable();
            $table->string('third_title')->nullable();
            $table->string('image');
            $table->boolean('status')->default(true);
            $table->string('page')->default('home'); //home,products, about, branch,partner,blog,news,contact
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
