<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateDowntimeRecordsTable extends Migration
{
    public function up()
    {
        Schema::create('downtime_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained('assets')->onDelete('cascade');
            $table->foreignId('work_order_id')->nullable()->constrained('work_orders')->onDelete('set null');
            $table->datetime('start_time');
            $table->datetime('end_time')->nullable();
            $table->enum('downtime_type', ['planned', 'unplanned']);
            $table->enum('reason', ['maintenance', 'breakdown', 'no_operator', 'no_material', 'other']);
            $table->text('description')->nullable();
            $table->decimal('cost_impact', 12, 2)->nullable();
            $table->foreignId('reported_by')->constrained('users')->onDelete('restrict');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('downtime_records');
    }
}