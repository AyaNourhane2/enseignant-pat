<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetsTable extends Migration
{
    public function up()
    {
        Schema::create('projets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enseignant_id');
            $table->string('titre');
            $table->text('description');
            $table->string('mots_cles')->nullable();
            $table->string('technologies')->nullable();
            $table->timestamps();

            $table->foreign('enseignant_id')->references('id')->on('enseignants')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('projets');
    }
}
