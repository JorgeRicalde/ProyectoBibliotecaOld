<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservaciones', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('dias_de_prestamo')->unsigned();
            $table->dateTime('fecha_de_reservacion')->useCurrent();
            $table->foreignId('ejemplar_id')->constrained('ejemplares')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('lector_id')->constrained('usuarios')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservaciones');
    }
}
