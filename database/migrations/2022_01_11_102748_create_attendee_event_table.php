<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendeeEventTable extends Migration
{

    public function up()
    {
        Schema::create('attendee_event', function (Blueprint $table) {
            $table->foreignId('attendee_id');
            $table->foreignId('event_id');
        });
    }


    public function down()
    {
        Schema::dropIfExists('attendee_event');
    }
}
