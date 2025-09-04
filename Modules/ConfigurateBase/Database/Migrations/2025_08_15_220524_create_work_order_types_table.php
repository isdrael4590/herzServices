<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkOrderTypesTable extends Migration
{
    public function up()
    {
        Schema::create('work_order_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->string('color')->default('#3B82F6');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('work_order_types');
    }
}