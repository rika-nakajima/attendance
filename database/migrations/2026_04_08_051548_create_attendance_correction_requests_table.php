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
    Schema::create('attendance_correction_requests', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('attendance_id');
        $table->unsignedBigInteger('user_id');

        // 修正前
        $table->dateTime('before_clock_in')->nullable();
        $table->dateTime('before_clock_out')->nullable();
        $table->json('before_breaks')->nullable();

        // 修正後
        $table->dateTime('after_clock_in')->nullable();
        $table->dateTime('after_clock_out')->nullable();
        $table->json('after_breaks')->nullable();

        $table->text('note')->nullable();
        $table->tinyInteger('status')->default(0); // 0:承認待ち 1:承認済み 2:却下

        $table->timestamps();

        $table->foreign('attendance_id')->references('id')->on('attendances')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_correction_requests');
    }
};
