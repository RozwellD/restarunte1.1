<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('sucursals', function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email');
            $table->boolean('active')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sucursals');
    }
};
