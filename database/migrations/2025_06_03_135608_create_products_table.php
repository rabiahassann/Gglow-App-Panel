<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
           $table->foreignId('subcategory_id')->nullable()->constrained('sub_categories')->onDelete('cascade');
            $table->string('location');
            $table->string('number');
            $table->json('images')->nullable();
            $table->text('overview');
            $table->text('entry_access');
            $table->text('exlusive_benefits');
            $table->text('kids_nannyxs');
            $table->json('type')->nullable();
            $table->decimal('price', 10, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
