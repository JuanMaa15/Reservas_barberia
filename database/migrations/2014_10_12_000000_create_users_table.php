<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        // Schema::create('users', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('nombre');
        //     $table->string('email')->unique();
        //     $table->timestamp('email_verified_at')->nullable();
        //     $table->string('password');
        //     $table->rememberToken();
        // }); 


        DB::statement('
            CREATE TABLE users (
                id INT NOT NULL AUTO_INCREMENT,
                nombre VARCHAR(255) NOT NULL,
                apellido VARCHAR(255),
                telefono VARCHAR(40),
                email VARCHAR(255) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                imagen VARCHAR(255),
                created_at DATETIME,
                updated_at DATETIME,
                remember_token VARCHAR(255),
                CONSTRAINT pk_users PRIMARY KEY(id)
                
            )ENGINE=InnoDb;
        ');
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
