<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('picture');
            $table->string('name');
            $table->dateTime('age');
            $table->enum('sex', ['male', 'female']);
            $table->string('coat');
            $table->text('temperament');
            $table->enum('status', ['adoptable', 'adopted', 'in_care', 'unavailable']);
            $table->foreignId('species_id');
            $table->foreignId('vaccines_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
