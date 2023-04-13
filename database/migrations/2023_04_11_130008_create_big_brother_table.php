<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBigBrotherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('big_brother_funds', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('account_id')->unsigned();
            $table->decimal('capital', 10, 2);
            $table->date('period_from');
            $table->date('period_to');
            $table->decimal('total_expense', 10, 2);
            $table->decimal('total_cashback', 10, 2);
            $table->enum('status', ['active', 'closed', 'processing'])->default('active');
            $table->bigInteger('user_id');
            $table->bigInteger('branch_id');
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
        Schema::dropIfExists('big_brother_funds');
    }
}
