<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Migrate existing JSON images to product_images table
        DB::table('products')
            ->whereNotNull('images')
            ->orderBy('id')
            ->each(function ($product) {
                $images = json_decode($product->images, true);
                if (is_array($images) && count($images) > 0) {
                    $rows = [];
                    foreach ($images as $index => $image) {
                        $rows[] = [
                            'product_id' => $product->id,
                            'image' => $image,
                            'sort_order' => $index,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                    DB::table('product_images')->insert($rows);
                }
            });

        // Drop the images column from products table
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('images');
        });
    }

    public function down(): void
    {
        // Restore images column
        Schema::table('products', function (Blueprint $table) {
            $table->json('images')->nullable()->after('tags');
        });

        // Restore data from product_images table
        DB::table('product_images')
            ->orderBy('product_id')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->groupBy('product_id')
            ->each(function ($images, $productId) {
                $paths = $images->pluck('image')->values()->toArray();
                DB::table('products')
                    ->where('id', $productId)
                    ->update(['images' => json_encode($paths)]);
            });
    }
};
