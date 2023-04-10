<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherIncomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_income', function (Blueprint $table) {
            $table->id();
            $table->datetime('other_income_date');
            $table->bigInteger('other_income_category_id')->unsigned();
            $table->decimal('amount', 10, 2);
            $table->string('reference')->nullable();
            $table->text('notes')->nullable();
            $table->string('attachment')->nullable();
            $table->bigInteger('created_user_id')->nullable();
            $table->bigInteger('updated_user_id')->nullable();
            $table->timestamps();

            $table->foreign('other_income_category_id')->references('id')->on('other_income_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('other_income');
    }
}
