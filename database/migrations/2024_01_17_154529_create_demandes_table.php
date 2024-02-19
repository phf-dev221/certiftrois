<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->integer('duree');
            $table->string('email');
            $table->longText('details')->nullable();
            $table->string('media');
            $table->integer('phone');
            $table->boolean('estValide')->default(1);
            $table->string('nom');
            $table->enum('etat',['en attente','accepte','refuse'])->default('en attente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandes');
    }
};
