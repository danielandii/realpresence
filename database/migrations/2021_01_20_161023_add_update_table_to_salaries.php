<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUpdateTableToSalaries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salaries', function (Blueprint $table) {
            $table->bigInteger('gaji_pokok_salary')->default(0)->change();
            $table->bigInteger('uang_makan_salary')->default(0)->change();
            $table->bigInteger('bonus')->default(0)->change();
            $table->bigInteger('potongan_lain')->default(0)->change();
            $table->bigInteger('pph')->default(0)->change();
            $table->float('pph_percentage', 8, 5)->default(0)->change();
            $table->bigInteger('bpjs')->default(0)->change();
            $table->float('bpjs_percentage', 8, 5)->default(0)->change();
            $table->bigInteger('gaji_kotor')->default(0)->change();
            $table->bigInteger('gaji_bersih')->default(0)->change();
            $table->bigInteger('status')->default(0)->change();
            $table->bigInteger('user_id')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('salaries', function (Blueprint $table) {
            //
        });
    }
}
