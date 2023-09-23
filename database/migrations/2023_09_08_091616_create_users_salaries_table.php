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
        Schema::create('users_salaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained()->onDelete("cascade");
            $table->foreignId("areas_of_work_id")->constrained()->onDelete("cascade");
            $table->foreignId("position_id")->constrained()->onDelete("cascade");
            $table->string("salary_type_id")->constrained()->onDelete("cascade");
            $table->float("total",8,2,true);
            $table ->tinyInteger("status")->default("0")->comment("0 = Active, 1=Inactive");
            $table->string("created_by")->nullable();
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
        Schema::dropIfExists('users_salaries');
    }
};
