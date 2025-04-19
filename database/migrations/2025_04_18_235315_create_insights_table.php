<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  // migration
public function up()
{
    Schema::create('insights', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('historia_id');
        $table->text('message');
        $table->timestamps();

        // Foreign key
        $table->foreign('historia_id')->references('id')->on('tcc_historia')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insights');
    }
};
