<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('users');
        
        Schema::disableForeignKeyConstraints();

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('role');
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('company_id');
            $table->foreign('job_id')->references('job_id')->on('jobs');
            $table->foreign('company_id')->references('company_id')->on('companies');
            $table->rememberToken();
            $table->timestamps();
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
        if (Schema::hasColumn('users', 'job_id')) {
            $table->dropForeign('job_id'); 
            $table->dropIndex('job_id');
            $table->dropColumn('job_id');
        }
        if (Schema::hasColumn('users', 'company_id')) {
            $table->dropForeign('company_id'); 
            $table->dropIndex('company_id');
            $table->dropColumn('company_id');
        }
        Schema::dropIfExists('users');
    }
}
