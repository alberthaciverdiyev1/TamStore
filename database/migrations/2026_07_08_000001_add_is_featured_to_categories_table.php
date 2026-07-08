<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            if (!Schema::hasColumn('categories', 'is_featured')) {
                $table->boolean('is_featured')->default(false);
            }
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->string('image')->nullable()->change();
            $table->json('info')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('is_featured');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->string('image')->nullable(false)->change();
            $table->json('info')->nullable(false)->change();
        });
    }
};
