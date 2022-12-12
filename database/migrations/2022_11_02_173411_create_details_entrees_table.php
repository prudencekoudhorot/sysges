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
        Schema::create('details_entrees', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('articles_id')->nullable();
            $table->foreign('articles_id')->references('id')->on('articles');
            $table->text('quantite');
            $table->text('prix_unitaire')->nullable();
            $table->text('prix_total')->nullable();
            $table->text('reference');
            $table->text('observation');
            $table->unsignedBigInteger('entrees_id')->nullable();
            $table->foreign('entrees_id')->references('id')->on('entrees_produits');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
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
        Schema::dropIfExists('details_entrees');
    }
};
