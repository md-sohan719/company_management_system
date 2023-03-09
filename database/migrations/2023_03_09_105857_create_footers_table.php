<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateFootersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footers', function (Blueprint $table) {
            $table->id();
            $table->string('number')->nullable();
            $table->string('short_description')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('copyright')->nullable();
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('footers')->insert(
            array(
                'number' => '+81383 766 284',
                'short_description' => 'I love to work in User Experience & User Interface designing.',
                'address' => 'Bangladesh',
                'email' => 'noreply@envato.com',
                'facebook' => 'https://www.facebook.com/',
                'twitter' => 'https://twitter.com/',
                'copyright' => 'Copyright @ Theme_Pure 2021 All right Reserved',
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
        Schema::dropIfExists('footers');
    }
}
