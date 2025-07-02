<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBuildingNameToContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('contacts', function (Blueprint $table) {
        $table->string('building_name')->nullable()->after('address');
    });
}

public function down()
{
    Schema::table('contacts', function (Blueprint $table) {
        $table->dropColumn('building_name');
    });
}

}
