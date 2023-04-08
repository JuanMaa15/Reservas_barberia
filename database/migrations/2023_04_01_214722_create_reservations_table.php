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
        DB::statement('
            CREATE TABLE reservations (
                id INT NOT NULL AUTO_INCREMENT,
                user_id INT NOT NULL,
                hour_id INT NOT NULL,
                nombre VARCHAR(255) NOT NULL,
                apellido VARCHAR(255),
                telefono VARCHAR(40),
                correo VARCHAR(255),
                fecha DATE NOT NULL,
                estado INT NOT NULL,
                created_at DATETIME,
                updated_at DATETIME,
                CONSTRAINT pk_reservations PRIMARY KEY(id),
                CONSTRAINT fk_reservations_users FOREIGN KEY(user_id) REFERENCES users(id),
                CONSTRAINT fk_reservations_hours FOREIGN KEY(hour_id) REFERENCES hours(id)
            
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
        Schema::table('reservations', function (Blueprint $table) {
            //
        });
    }
};
