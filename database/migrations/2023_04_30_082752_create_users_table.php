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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table ->tinyInteger("role_as")->default("0")->comment("0 = user, 1=admin");
            $table ->tinyInteger("status")->default("0")->comment("0 = Active, 1=Inactive");
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string("phone")->unique()->nullable();
            $table->string("gender")->nullable();
            $table->bigInteger("identity_number")->unique()->nullable();        
            $table->string("county")->nullable();
            $table->string("division")->nullable();
            $table->string("district")->nullable();
            $table->string("location")->nullable();
            $table->string("sub_location")->nullable();    

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
