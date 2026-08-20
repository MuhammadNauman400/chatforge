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
        Schema::table('companies', function (Blueprint $table) {
            $table->string('company_logo')->nullable()->after('slug');
            $table->text('header_content')->nullable()->after('company_logo');
            $table->text('about_us_content')->nullable()->after('header_content');
            $table->text('services_content')->nullable()->after('about_us_content');
            $table->string('contact_info')->nullable()->after('services_content');
            $table->string('social_email')->nullable()->after('contact_info');
            $table->string('social_phone')->nullable()->after('social_email');
            $table->text('chatbot_embed_code')->nullable()->after('social_phone');
            $table->string('website_theme')->default('default_bootstrap')->after('chatbot_embed_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn([
                'company_logo',
                'header_content',
                'about_us_content',
                'services_content',
                'contact_info',
                'social_email',
                'social_phone',
                'chatbot_embed_code',
                'website_theme',
            ]);
        });
    }
};
