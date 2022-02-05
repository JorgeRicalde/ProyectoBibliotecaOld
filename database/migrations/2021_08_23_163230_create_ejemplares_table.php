<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateEjemplaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estados_de_los_ejemplares', function (Blueprint $table) {
            $table->id();
            $table->string('estado_del_ejemplar', 30);
        });

        Schema::create('estados_fisicos_de_los_ejemplares', function (Blueprint $table) {
            $table->id();
            $table->string('estado_fisico_del_ejemplar', 50);
            $table->string('descripcion', 200)->default('Sin descripcion');
        });

        Schema::create('ejemplares', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estado_del_ejemplar_id')->constrained('estados_de_los_ejemplares')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('libro_id')->constrained('libros')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('ejemplares_x_estados_fisicos_de_los_ejemplares', function (Blueprint $table) {
            $table->unsignedBigInteger('ejemplar_id');
            $table->unsignedBigInteger('estado_fisico_del_ejemplar_id');

            $table->foreign('ejemplar_id', 'ejemplares_x_estados_fisicos__ejemplares_fk')
                ->references('id')
                ->on('ejemplares')
                ->onDelete('cascade');

            $table->foreign('estado_fisico_del_ejemplar_id', 'ejemplares_x_estados_fisicos__estados_de_los_ejemplares_fk')
                ->references('id')
                ->on('estados_fisicos_de_los_ejemplares')
                ->onDelete('cascade');

            $table->primary(['ejemplar_id', 'estado_fisico_del_ejemplar_id'], 'ejemplares_x_estados_fisicos_de_los_ejemplares_pk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ejemplares_x_estados_fisicos_de_los_ejemplares');
        Schema::dropIfExists('ejemplares');
        Schema::dropIfExists('estados_fisicos_de_los_ejemplares');
        Schema::dropIfExists('estados_de_los_ejemplares');
    }
}
