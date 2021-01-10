<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Jobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('jobs');
        Schema::disableForeignKeyConstraints();

        Schema::create('jobs', function (Blueprint $table) {
            $table->id("job_id");
            $table->string('title');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('company_id')->on('companies')->onDelete('cascade');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForeign('company_id'); 
        $table->dropIndex('company_id');
        $table->dropColumn('company_id');

        Schema::dropIfExists('jobs');
    }
}
