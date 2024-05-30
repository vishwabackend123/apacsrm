<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_details', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_code');
            $table->string('md_name');
            $table->string('md_email');
            $table->string('md_phone');
            $table->string('md_connect');

            $table->string('principle_name');
            $table->string('principle_email');
            $table->string('principle_phone');
            $table->string('principle_connect');

            $table->string('finance_name');
            $table->string('finance_email');
            $table->string('finance_phone');
            $table->string('finance_connect');

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
        Schema::dropIfExists('vendor_details');
    }
};
