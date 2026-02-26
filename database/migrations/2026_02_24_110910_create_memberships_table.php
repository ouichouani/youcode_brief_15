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
        Schema::create('memberships', function (Blueprint $table) {

            $table->id();
            $table->foreignId('member_id')->references('id')->on('users')->onDelete('cascade') ;
            $table->foreignId("colocation_id")->references('id')->on('colocations')->onDelete('cascade') ;
            $table->enum('status', ['valid', 'invalid'])->default('valid');
            $table->enum('role', ['owner', 'member'])->default('member');

            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
