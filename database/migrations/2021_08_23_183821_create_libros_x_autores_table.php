<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibrosXAutoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libros_x_autores', function (Blueprint $table) {
            $table->unsignedBigInteger('libro_id');
            $table->unsignedBigInteger('autor_id');

            $table->foreign('libro_id', 'libros_x_autores__libros_fk')
                ->references('id')
                ->on('libros')
                ->onDelete('cascade');

            $table->foreign('autor_id', 'libros_x_autores__autores_fk')
                ->references('id')
                ->on('autores')
                ->onDelete('cascade');

            $table->primary(['libro_id', 'autor_id'], 'libros_x_autores_pk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('libros_x_autores');
    }
}
