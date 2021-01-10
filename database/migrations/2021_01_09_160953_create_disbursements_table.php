<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisbursementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disbursements', function (Blueprint $table) {
            $table->id();
            $table->string('disbursement_id');
            $table->bigInteger('amount');
            $table->string('status');
            $table->dateTime('disbursement_timestamp');
            $table->string('bank_code');
            $table->string('account_number');
            $table->string('beneficiary_name');
            $table->string('remark');
            $table->text('receipt')->nullable();
            $table->dateTime('disbursement_time_served')->nullable();
            $table->integer('fee');
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
        Schema::dropIfExists('disbursements');
    }
}
