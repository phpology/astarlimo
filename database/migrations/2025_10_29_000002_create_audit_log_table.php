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
        Schema::create('audit_log', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->nullable();
            $table->integer('user_id')->default(0)->nullable();
            $table->string('user')->nullable();
            $table->string('task')->nullable();
            $table->longText('data')->nullable();
            $table->integer('is_impersonated')->default(0)->nullable();
            $table->integer('impersonate_by_id')->default(0)->nullable();
            $table->string('impersonated_by')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->date('createdate_date')->nullable();
            $table->string('status');
            $table->integer('is_deleted')->default(0)->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_log');
    }
};
