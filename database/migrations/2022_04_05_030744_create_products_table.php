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
            $table->decimal("price", 9, 2);
            $table->smallInteger("premium")->default(0);
            $table->text("colors");
            $table->string("quantity");
            $table->bigInteger("sells")->default(0);
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
