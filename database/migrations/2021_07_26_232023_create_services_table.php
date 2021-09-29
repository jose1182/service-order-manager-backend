<?php

use Facade\Ignition\Tabs\Tab;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('order_service');
            $table->date('issue_date')->nullable();


            $table->unsignedBigInteger('project_id')->nullable();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('technician_id')->nullable();
            $table->unsignedBigInteger('responsible_id')->nullable();

            $table->text('description', 500)->nullable();

            $table->boolean('isIncidence')->nullable();
            $table->text('incidence_description')->nullable();

            $table->boolean('isFinished')->nullable();
            $table->integer('invested_hours')->nullable();
            $table->date('end_date')->nullable();


            $table->boolean('isCheckedByTechnician')->nullable();
            $table->boolean('isCheckedByCoordinator')->nullable();
            $table->boolean('isCheckedByAccount')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('set null');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('set null');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');

            $table->foreign('technician_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('responsible_id')->references('id')->on('users')->onDelete('set null');

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
        Schema::dropIfExists('services');
    }
}
