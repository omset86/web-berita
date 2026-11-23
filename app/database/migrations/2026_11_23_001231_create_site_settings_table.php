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
        Schema::disableForeignKeyConstraints();

        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name', 100)->default('BeritaKita');
            $table->string('site_tagline', 255)->nullable();
            $table->text('ticker_text')->nullable();
            $table->boolean('ticker_enabled')->default(true);
            $table->string('location_text', 100)->default('Jakarta, Indonesia');
            $table->text('footer_about')->nullable();
            $table->string('footer_address', 255)->nullable();
            $table->string('footer_phone', 50)->nullable();
            $table->string('footer_email', 100)->nullable();
            $table->string('social_facebook', 255)->nullable();
            $table->string('social_twitter', 255)->nullable();
            $table->string('social_instagram', 255)->nullable();
            $table->string('social_youtube', 255)->nullable();
            $table->string('meta_title', 255)->nullable();
            $table->text('meta_description')->nullable();
            $table->string('google_analytics', 50)->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
