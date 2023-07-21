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
        Schema::create('group_interviews', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('block_id');
            $table->json('group_users')->nullable();
            $table->integer('total_candidates')->nullable();
            $table->integer('pass_candidates')->default(0);
            $table->unsignedBigInteger('assigned_by');
            $table->timestamps();
            $table->foreign('block_id')->references('id')->on('blocks')->onDelete('cascade');
            $table->foreign('assigned_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_interviews');
    }
};
