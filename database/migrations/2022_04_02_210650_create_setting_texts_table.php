<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_texts', function (Blueprint $table) {
            $table->id();
            $table->integer('language_id');
            $table->string('site_title');
            $table->string('site_description');
            $table->string('site_keywords');
            $table->string('site_footer_text');
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
        Schema::dropIfExists('setting_texts');
    }
}
