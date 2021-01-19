<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('month')->nullable();
            $table->smallInteger('year')->nullable();
            $table->bigInteger('gaji_pokok_salary')->nullable();
            $table->bigInteger('uang_makan_salary')->nullable();
            $table->bigInteger('bonus')->default(0)->nullable();
            $table->bigInteger('potongan_lain')->default(0)->nullable();
            $table->bigInteger('pph')->default(0)->nullable();
            $table->tinyInteger('pph_percentage')->default(0)->nullable();
            $table->bigInteger('bpjs')->default(0)->nullable();
            $table->tinyInteger('bpjs_percentage')->default(0)->nullable();
            $table->bigInteger('gaji_kotor')->default(0)->nullable();
            $table->bigInteger('gaji_bersih')->default(0)->nullable();
            $table->tinyInteger('status')->default(0)->nullable();
            $table->bigInteger('user_id')->default(0)->nullable();
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
        Schema::dropIfExists('salaries');
    }
}
