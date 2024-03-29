<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChartsOfAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charts_of_account', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id');
            $table->string('name')->require();
            $table->string('code')->require();
            $table->boolean('allow_manual')->default(false);
            $table->string('notes')->nullable();
            $table->enum('account_type', ['assets', 'equity', 'expense', 'income', 'liability'])->default('assets');
            $table->integer('created_user_id')->unsigned();
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('charts_of_account');
    }
}
