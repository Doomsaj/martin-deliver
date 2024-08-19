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
        Schema::create('consignments', function (Blueprint $table) {
            $table->id();
            $table->string("code", 36)->unique();
            $table->string("status");
            $table->decimal("starting_latitude", 10, 8);
            $table->decimal("starting_longitude", 11, 8);
            $table->string("sender_name", 255);
            $table->text("sender_address");
            $table->string("sender_phone", 11);
            $table->decimal("destination_latitude", 10, 8);
            $table->decimal("destination_longitude", 11, 8);
            $table->string("recipient_name", 255);
            $table->text("recipient_address");
            $table->string("recipient_phone", 11);
            $table->foreignId("client_id")->constrained();
            $table->foreignId("courier_id")->nullable()->constrained();
            $table->dateTime("started_at")->nullable();
            $table->dateTime("finished_at")->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consignments');
    }
};
