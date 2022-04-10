<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->text("description");
            $table->decimal("price", 9, 3);
            $table->smallInteger("premium")->default(0);
            $table->text("avilable_colors");
            $table->string("avilable_quantity");
            $table->bigInteger("sells")->default(0);
            $table->string("main_image");
            $table->string("another_images")->nullable();
            $table->unsignedBigInteger("sub_cat_id");
            $table->foreign("sub_cat_id")->references("id")->on("sub_categories")->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger("category_id");
            $table->foreign("category_id")->references("id")->on("categories")->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
