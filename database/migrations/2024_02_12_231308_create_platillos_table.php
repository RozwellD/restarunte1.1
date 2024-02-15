<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('platillos', function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->foreignUuid('branch_id')->references('id')->on('sucursals')->cascadeOnDelete();
            $table->string('name');
            $table->longText('description');
            $table->string('elaboration_duration');
            $table->integer('production_cost');
            $table->integer('sale_price');
            $table->boolean('active');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('platillos');
    }
};
