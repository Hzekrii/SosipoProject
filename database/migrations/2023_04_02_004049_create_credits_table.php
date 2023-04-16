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
        Schema::create('credits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('adherent_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->text('designation');
            $table->double('montant');
            $table->integer('modepaiement');
            $table->boolean('approuve');
            $table->date('date_credit');
            $table->string('file');
            $table->foreignId('solde_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credits');
    }
};
