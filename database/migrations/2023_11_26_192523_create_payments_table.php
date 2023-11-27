<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
return new class extends Migration {

	public function up()
	{
		Schema::create('payments', function(Blueprint $table) {
			$table->id('id');
			$table->bigInteger('transaction_id')->unsigned()->nullable();
			$table->float('amount', 50,2);
			$table->date('paid_on');
			$table->text('details')->nullable();
			$table->timestamps();
			$table->foreign('transaction_id')->references('id')
			                                 ->on('transactions')
			                                 ->onDelete('set null')
			                                 ->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::drop('payments');
	}
};