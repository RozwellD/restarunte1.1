<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->foreignUuid('attendant_id')->references('id')->on('users');
            $table->foreignUuid('branch_id')->references('id')->on('sucursals');
            $table->string('table');
            $table->json('platillos_id')->default("[]");
            $table->integer('tip')->default(0);
            $table->date('date');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
