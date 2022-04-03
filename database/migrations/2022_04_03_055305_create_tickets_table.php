<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('post_method' , ['web' , 'webService' , 'email' , 'app' , 'panel']);
            $table->enum('importance' , ['high' , 'normal' , 'low' , 'emergency'])->default('normal');
            $table->enum('status' , ['answered' , 'closed' , 'pending' , 'locked' , 'transferred'])->default('pending');
            $table->dateTime('last_message')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('last_response')->nullable();
            $table->dateTime('last_close')->nullable();
            $table->dateTime('last_open')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('department_id')->index();

            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
