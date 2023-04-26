<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomFieldsMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_fields_meta', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('belongs_to')->nullable();
            $table->integer('member_id')->default(0);
            $table->integer('custom_field_id')->unsigned();
            $table->string('value')->nullable();
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
        Schema::dropIfExists('custom_fields_meta');
    }
}
