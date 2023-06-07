<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('remboursements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('credit_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->text('designation')->nullable();
            $table->double('montant');
            $table->boolean('approuve');
            $table->foreignId('user_id')->constrained('users')->default('2');
            $table->date('date_remboursement');
            $table->string('feuille');
            $table->foreignId('solde_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remboursements');
    }
};
