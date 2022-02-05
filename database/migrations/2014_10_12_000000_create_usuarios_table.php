<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('estados_de_los_usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('estado_del_usuario', 30);
        });

        Schema::create('generos', function (Blueprint $table) {
            $table->id();
            $table->string('genero', 30);
        });

        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('last_name', 100);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('dni', 10)->unique()->nullable();
            $table->string('celular', 15)->nullable();
            $table->string('imagen')->nullable();
            $table->rememberToken();
            $table->timestamp('fecha_registro')->useCurrent();
            $table->timestamp('fecha_actualizacion')->useCurrent()->useCurrentOnUpdate();
            $table->timestamp('email_verified_at')->nullable();
            $table->foreignId('estado_del_usuario_id')->constrained('estados_de_los_usuarios')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('genero_id')->constrained('generos')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
        Schema::dropIfExists('generos');
        Schema::dropIfExists('estados_de_los_usuarios');
    }
}
