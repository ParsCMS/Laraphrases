<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhrasesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('phrases', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id')->unsigned();
            $table->string('locale');
            $table->string('key');
            $table->text('value');
            $table->enum('aprove', array('0', '1'))->default('0');
            $table->timestamps();

            $table->unique(array('locale', 'key','aprove'));
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('phrases');
	}

}
