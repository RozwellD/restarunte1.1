<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->after('email',function (Blueprint $table){
                $table->uuid('sucursal_id')->nullable();
                $table->string('phone')->nullable();
                $table->string('type')->nullable();
            });
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('type');
        });
    }
};
