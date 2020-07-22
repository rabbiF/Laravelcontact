<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->date('date_contact');
            $table->string('name');
            $table->string('firstname');
            $table->string('email');
            $table->string('phone');
            $table->string('contact_origine')->nullable();
            $table->string('projet')->nullable();
            $table->string('type_de_bien')->nullable();
            $table->string('etat')->nullable();
            $table->string('typologie')->nullable();
            $table->string('secteur')->nullable();
            $table->text('commentaires')->nullable();
            $table->string('contact')->nullable();
            $table->string('suivi')->nullable();
            $table->string('budget')->nullable();
            $table->string('propositions')->nullable();
            $table->string('visites')->nullable();
            $table->string('client_nego')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
