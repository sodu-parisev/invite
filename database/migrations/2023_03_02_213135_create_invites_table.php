<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\PaymentStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invites', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('full_name', 400);
            $table->string('work_place');
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('passport')->nullable();
            $table->string('diploma')->nullable();
            $table->string('form_of_attendance')->default();
            $table->string('token');
            $table->string('payment_status')->default(PaymentStatus::Pending->value);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invites');
    }
};
