<?php
// database/migrations/2024_12_13_123456_create_projets_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetsTable extends Migration
{
    public function up()
    {
        Schema::create('projets', function (Blueprint $table) {
            $table->id(); // Identifiant unique pour chaque projet
            $table->string('titre'); // Titre du projet
            $table->text('description'); // Description détaillée du projet
            $table->string('mots_cles'); // Mots-clés associés au projet
            $table->string('technologies'); // Technologies utilisées dans le projet
            $table->enum('statut', ['ouvert', 'en_cours', 'termine'])->default('ouvert'); // Statut du projet
            $table->foreignId('enseignant_id')->constrained('utilisateurs'); // Lien avec l'enseignant via la table 'utilisateurs'
            $table->timestamps(); // Horodatage des créations et mises à jour
        });
    }

    public function down()
    {
        Schema::dropIfExists('projets'); // Supprimer la table lors du rollback de la migration
    }
}
