<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('attendances', function (Blueprint $table) {
        $table->id(); // unsignedBigInteger
        $table->unsignedBigInteger('user_id');
        $table->date('date'); // 勤務日
        $table->time('clock_in')->nullable();   // 出勤
        $table->time('clock_out')->nullable();  // 退勤

        $table->tinyInteger('status')->default(0); // 0:勤務外 1:出勤中 2:休憩中 3:退勤済
        $table->text('note')->nullable();
        $table->timestamps();

        // 外部キー
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
