<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUpdateTableToDeductions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deductions', function (Blueprint $table) {
            $table->float('pph_percentage', 8, 5)->default(0)->change();
            $table->float('bpjs_percentage', 8, 5)->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deductions', function (Blueprint $table) {
            //
        });
    }
}
