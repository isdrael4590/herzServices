<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateinformatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informats', function (Blueprint $table) {
            $table->id();
            $table->string('insumo_name');
            $table->string('insumo_code')->nullable();
            $table->string('insumo_type')->nullable();
            $table->string('insumo_temp');
            $table->string('insumo_lot');
            $table->date('insumo_exp');
            $table->string('insumo_unit');
            $table->string('insumo_status');
            $table->integer('insumo_quantity')->nullable();
            $table->text('insumo_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('informats');
    }
}
