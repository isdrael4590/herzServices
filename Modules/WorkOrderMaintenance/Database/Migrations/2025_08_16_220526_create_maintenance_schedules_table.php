<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateMaintenanceSchedulesTable extends Migration
{
    public function up()
    {
        Schema::create('maintenance_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('asset_id')->constrained('assets')->onDelete('cascade');
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('frequency_type', ['days', 'weeks', 'months', 'years', 'hours', 'miles', 'cycles']);
            $table->integer('frequency_value');
            $table->date('start_date');
            $table->date('next_due_date');
            $table->date('last_completed')->nullable();
            $table->decimal('estimated_hours', 8, 2)->nullable();
            $table->decimal('estimated_cost', 12, 2)->nullable();
            $table->text('instructions')->nullable();
            $table->enum('status', ['active', 'inactive', 'paused'])->default('active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('maintenance_schedules');
    }
}