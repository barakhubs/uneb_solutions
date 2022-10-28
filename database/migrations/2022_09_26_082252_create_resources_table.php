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
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('tag_id');
            $table->string('title');
            $table->string('slug');
            $table->string('price')->nullable();
            $table->string('file');
            $table->string('type');
            $table->string('size');
            $table->text('description')->nullable();
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('class_id')->references('id')->on('classes')->change()
            ->constrained()
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->foreign('tag_id')->references('id')->on('tags')->change()
            ->constrained()
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->foreign('subject_id')->references('id')->on('subjects')->change()
            ->constrained()
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resources');
    }
};
