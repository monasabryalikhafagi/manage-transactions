<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration {

	public function up()
	{
		Schema::create('transactions', function(Blueprint $table) {
			$table->id('id');
			$table->float('amount', 50,2);
			$table->bigInteger('user_id')->unsigned()->nullable();
			$table->date('due_on');
			$table->float('vat', 2,2);
			$table->boolean('is_vat_inclusive');
			$table->enum('status', array('paid', 'outstanding', 'overdue'));
			$table->timestamps();
			$table->foreign('user_id')->references('id')
			                          ->on('users')
			                          ->onDelete('set null')
			                          ->onUpdate('cascade');
			

		});
	}

	public function down()
	{
		Schema::drop('transactions');
	}
};