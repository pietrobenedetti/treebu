<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fields', function (Blueprint $table) {
            $table->id();
            $table->text("municipality")->nullable;
            $table->text("img");
            $table->float("dimension");
            $table->string("cadastral_sheet");
            $table->string("cadastral_map");
            $table->string("cadastral_parcel");
            $table->text("ground_type");
            $table->text("irrigation_type");
            $table->text("offer_type");
            $table->float("offer_fee");
            $table->boolean("availability");
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
        Schema::dropIfExists('fields');
    }
}
