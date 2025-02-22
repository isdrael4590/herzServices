<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMachinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('DescActivo');
            $table->string('IDActivo')->unique()->nullable();
            $table->string('DescMarca')->nullable();
            $table->string('DescModelo')->nullable();
            $table->string('DescCliente')->nullable();
            $table->string('date_manufacture')->nullable();
            $table->text('machine_note')->nullable();
            $table->text('machine_barcode_symbology')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->restrictOnDelete();
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
        Schema::dropIfExists('machines');
    }
}
