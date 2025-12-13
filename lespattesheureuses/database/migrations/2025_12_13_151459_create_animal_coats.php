<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('animal_coats', function (Blueprint $table) {
            $table->foreignId('animal_id')->constrained()->cascadeOnDelete();
            $table->foreignId('coat_id')->constrained()->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animal_coats');
    }
};
