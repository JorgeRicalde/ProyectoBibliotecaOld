<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibrosXSubClasificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libros_x_sub_clasificaciones', function (Blueprint $table) {
            $table->unsignedBigInteger('libro_id');
            $table->unsignedBigInteger('sub_clasificacion_id');

            $table->foreign('libro_id', 'libros_x_sub_clasificaciones__libros_fk')
                ->references('id')
                ->on('libros')
                ->onDelete('cascade');

            $table->foreign('sub_clasificacion_id', 'libros_x_sub_clasificaciones__sub_clasificaciones_fk')
                ->references('id')
                ->on('sub_clasificaciones')
                ->onDelete('cascade');

            $table->primary(['libro_id', 'sub_clasificacion_id'], 'libros_x_sub_clasificaciones_pk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('libros_x_sub_clasificaciones');
    }
}
