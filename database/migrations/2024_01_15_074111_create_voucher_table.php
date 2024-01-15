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
        Schema::create('voucher', function (Blueprint $table) {
            $table->id();
            $table->string('code_voucher');
            $table->decimal('amount', 8, 2);
            $table->integer('status');
            $table->integer('type');
            $table->date('start_date');
            $table->date('end_date');
            $table->date('use_date')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Thêm cột deleted_at cho xóa mềm
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voucher');
    }
};
