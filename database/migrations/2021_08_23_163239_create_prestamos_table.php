<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estados_de_los_prestamos', function (Blueprint $table) {
            $table->id();
            $table->string('estado_del_prestamo', 30);
        });

        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('dias_de_prestamo')->unsigned();
            $table->dateTime('fecha_prestamo')->useCurrent();
            $table->dateTime('fecha_devolucion')->nullable();
            $table->foreignId('estado_del_prestamo_id')->constrained('estados_de_los_prestamos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('ejemplar_id')->constrained('ejemplares')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('lector_id')->constrained('usuarios')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('bibliotecario_id')->constrained('usuarios')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prestamos');
        Schema::dropIfExists('estados_de_los_prestamos');
    }
}
