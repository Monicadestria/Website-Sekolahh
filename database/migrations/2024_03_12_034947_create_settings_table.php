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
        Schema::create('settings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('slug');
            $table->uuid('theme_id')->nullable();
            $table->string('school_name', 100);
            $table->string('visi_misi')->nullable();
            $table->string('post_code', 10)->nullable();
            $table->string('phone')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('email')->nullable();
            $table->text('maps')->nullable();
            $table->string('address')->nullable();
            $table->string('logo')->nullable();
            $table->text('desc')->nullable();
            $table->text('footer_desc')->nullable();
            $table->boolean('status')->nullable()->default(false);
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->softDeletes();
            $table->uuid('deleted_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
