<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSancionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_de_sanciones', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_de_sancion', 30);
            $table->tinyInteger('cantidad_de_dias')->unsigned();
        });

        Schema::create('estados_de_las_sanciones', function (Blueprint $table) {
            $table->id();
            $table->string('estado_de_la_sancion', 30);
        });

        Schema::create('sanciones', function (Blueprint $table) {
            $table->foreignId('id')->primary()->constrained('prestamos')->onUpdate('cascade')->onDelete('cascade');
            $table->date('fecha_inicio')->useCurrent();
            $table->date('fecha_fin')->nullable();
            $table->timestamp('fecha_sancion')->useCurrent();
            $table->foreignId('lector_id')->constrained('usuarios')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('estado_de_la_sancion_id')->constrained('estados_de_las_sanciones')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('tipo_de_sancion_id')->constrained('tipos_de_sanciones')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sanciones');
        Schema::dropIfExists('estados_de_las_sanciones');
        Schema::dropIfExists('tipos_de_sanciones');
    }
}
