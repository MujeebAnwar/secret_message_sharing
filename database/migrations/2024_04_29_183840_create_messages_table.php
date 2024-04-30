<?php

use App\Enum\MessageReadOption;
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
      
        Schema::create('messages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->longText('message')->nullable();
            $table->unsignedBigInteger('sender_id')->nullable();
            $table->unsignedBigInteger('recipient_id')->nullable();
            $table->enum('read_option',array_column(MessageReadOption::cases(),'value'))->comment('1 = Once , 2 = Custom')
            ->default(MessageReadOption::ONCE->value);
            $table->dateTime('expiry_at')->nullable();
            $table->foreign('sender_id')->references('id')->on('users');
            $table->foreign('recipient_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
