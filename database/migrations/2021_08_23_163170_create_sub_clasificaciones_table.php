<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubClasificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clasificaciones', function (Blueprint $table) {
            $table->id();
            $table->string('clasificacion', 100);
            $table->string('codigo_dewey', 3);
        });

        Schema::create('sub_clasificaciones', function (Blueprint $table) {
            $table->id();
            $table->string('sub_clasificacion', 100);
            $table->string('codigo_dewey', 3);
            $table->foreignId('clasificacion_id')->constrained('clasificaciones')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_clasificaciones');
        Schema::dropIfExists('clasificaciones');
    }
}
