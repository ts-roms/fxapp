<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBranchIdToOtherIncome extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('other_income', function (Blueprint $table) {
            //
            $table->bigInteger('branch_id')->unsigned()->nullable()->after('updated_user_id');

            $table->foreign('branch_id')->references('id')->on('branches')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('other_income', function (Blueprint $table) {
            //
            $table->dropForeign(['branch_id']);
            $table->dropColumn(['branch_id']);
        });
    }
}
