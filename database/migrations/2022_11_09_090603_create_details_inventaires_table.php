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
        Schema::create('details_inventaires', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('articles_id')->nullable();
            $table->foreign('articles_id')->references('id')->on('articles');
            $table->unsignedBigInteger('inventaires_id')->nullable();
            $table->foreign('inventaires_id')->references('id')->on('inventaires');
            $table->text('quantite_reste');
            $table->text('quantite_inventorie');
            $table->text('ecart');
            $table->text('observation')->nullable();
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
        Schema::dropIfExists('details_inventaires');
    }
};
