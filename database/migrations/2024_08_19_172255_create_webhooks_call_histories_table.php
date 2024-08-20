<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('webhook_call_histories', function (Blueprint $table) {
            $table->id();
            $table->string("url", "510");
            $table->boolean("has_error");
            $table->longText("error_message")->nullable();
            $table->longText('payload')->nullable();
            $table->longText('headers')->nullable();
            $table->longText("response")->nullable();
            $table->integer("status_code")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('webhooks_call_histories');
    }
};
