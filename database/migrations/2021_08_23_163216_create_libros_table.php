<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('idiomas', function (Blueprint $table) {
            $table->id();
            $table->string('idioma', 30);
        });

        Schema::create('editoriales', function (Blueprint $table) {
            $table->id();
            $table->string('editorial', 100);
        });

        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('titulo_slug')->unique();
            $table->smallInteger('anyo_de_lanzamiento')->unsigned();
            $table->string('imagen')->nullable();
            $table->integer('cantidad_de_ejemplares')->default(0);
            $table->timestamp('fecha_registro')->useCurrent();
            $table->timestamp('fecha_actualizacion')->useCurrent()->useCurrentOnUpdate();
            $table->foreignId('idioma_id')->constrained('idiomas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('editorial_id')->constrained('editoriales')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('libros');
        Schema::dropIfExists('editoriales');
        Schema::dropIfExists('idiomas');
    }
}
