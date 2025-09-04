<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetMeterReadingsTable extends Migration
{
    public function up()
    {
        Schema::create('asset_meter_readings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained('assets')->onDelete('cascade');
            $table->string('meter_type'); // hours, miles, cycles, etc.
            $table->decimal('reading', 12, 2);
            $table->datetime('reading_date');
            $table->foreignId('recorded_by')->constrained('users')->onDelete('restrict');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('asset_meter_readings');
    }
}