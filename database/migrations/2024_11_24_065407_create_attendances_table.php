<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id');  // Make sure this matches the type of 'employee_id' in the employees table
            $table->foreign('employee_id')->references('employee_id')->on('employees')->onDelete('cascade'); // Foreign key reference to employees table
            $table->string('status'); // 'in' or 'out'
            $table->time('time_in')->nullable();
            $table->time('time_out')->nullable();
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
