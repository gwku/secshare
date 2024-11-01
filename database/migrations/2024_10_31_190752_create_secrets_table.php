<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('secrets', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->string('token')->unique();
            $table->dateTime('expires_at');
            $table->integer('views')->default(0);
            $table->integer('max_views')->default(1);
            $table->string('revoke_token');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('secrets');
    }
};
