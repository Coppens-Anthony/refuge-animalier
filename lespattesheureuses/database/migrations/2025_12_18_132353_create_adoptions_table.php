<?php

use App\Enums\Adoptions;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('adoptions', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date')->nullable();
            $table->enum('status', Adoptions::values());
            $table->foreignId('animal_id')->constrained()->cascadeOnDelete();
            $table->foreignId('adopter_id')->constrained()->cascadeOnDelete();
            //notes
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adoptions');
    }
};
