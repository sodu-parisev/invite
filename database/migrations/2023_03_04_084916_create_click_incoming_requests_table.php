<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('click_incoming_requests', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('click_trans_id');
            $table->integer('service_id');
            $table->bigInteger('click_paydoc_id');
            $table->string('merchant_trans_id')
              ->comment('invite token');
            $table->float('amount');
            $table->smallInteger('action');
            $table->integer('error');
            $table->string('error_note')
                ->nullable();
            $table->timestamp('sign_time');
            $table->string('sign_string');
            $table->string('type');
            $table->foreignId('invite_id')
              ->references('id')
              ->on('invites')
              ->onDelete('cascade');
        });
    }
};
