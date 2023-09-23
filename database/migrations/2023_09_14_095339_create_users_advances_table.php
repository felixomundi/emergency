<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_advances', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained()->onDelete("cascade");
            $table ->tinyInteger("status")->default("0");
            $table->string("effective_date");
            $table->string("closing_date");
            $table->float("installment")->default("0.00");
            $table->bigInteger("period");
            $table->foreignId("purpose_id")->constrained()->onDelete("cascade");
            $table->float("amount",8,2,true)->default("0.00");
            $table->bigInteger("created_by")->nullable();
            $table->string("duration");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_advances');
    }
};
