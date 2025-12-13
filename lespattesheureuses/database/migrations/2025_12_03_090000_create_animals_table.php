<?php

use App\Enums\Sex;
use App\Enums\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('avatar');
            $table->string('name');
            $table->dateTime('age');
            $table->enum('sex', Sex::values());
            $table->string('coat');
            $table->text('temperament');
            $table->enum('status', Status::cases());
            $table->foreignId('breed_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
