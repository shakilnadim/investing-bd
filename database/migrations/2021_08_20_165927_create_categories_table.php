<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('name', 30);
            $table->string('slug', 30)->unique();
            $table->text('meta')->nullable();
            $table->boolean('is_published')->default(false);
            $table->boolean('is_on_primary_nav')->default(false);
            $table->boolean('is_in_home')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
