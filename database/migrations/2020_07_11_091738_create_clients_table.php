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
            $table->string('contact_origine');
            $table->string('projet');
            $table->string('etat');
            $table->string('typologie');
            $table->string('secteur');
            $table->text('commentaires');
            $table->string('contact');
            $table->string('suivi');
            $table->string('budget');
            $table->string('propositions');
            $table->string('visites');
            $table->string('client_nego');
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
