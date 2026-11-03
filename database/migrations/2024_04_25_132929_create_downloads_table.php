<?php

use Illuminate\Support\Facades\DB;
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
        Schema::create('downloads', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->uuid('category_download_id');
            $table->string('file');
            $table->string('title');
            $table->text('desc')->nullable();
            $table->integer('status')->default(1);
            $table->integer('click_download')->default(0);
            // $table->uuid('user_id');
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->timestamps();
            $table->uuid('deleted_by')->nullable();
            $table->softDeletes();

            //  $table->foreign('category_download_id')
            //       ->references('id')
            //       ->on('masters');
            
            // $table->foreign('user_id')
            //   ->references('id')
            //   ->on('users');
                
            // $table->foreign('category_download_id')->references('id')->on('category_downloads');
            // $table->foreign('created_by')->references('id')->on('users');
            // $table->foreign('updated_by')->references('id')->on('users');
            // $table->foreign('deleted_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('downloads');
    }
};
