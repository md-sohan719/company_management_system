<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateHomeSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_slides', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('short_title')->nullable();
            $table->string('home_slide')->nullable();
            $table->string('video_url')->nullable();
            $table->timestamps();
        });
        // Insert some stuff
        DB::table('home_slides')->insert(
            array(
                'title' => 'I will give you Best Product in the shortest time.',
                'short_title' => "I'm a Rasalina based product design & visual designer focused on crafting clean & user-friendly experiences",
                'home_slide' => '',
                'video_url' => 'https://www.youtube.com/watch?v=XHOmBV4js_E',
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('home_slides');
    }
}
