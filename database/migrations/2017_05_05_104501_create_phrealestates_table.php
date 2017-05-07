<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreatephrealestatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phrealestates', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('title');

            $table->string('postal_code')->nullable();
            $table->string('country')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();

            $table->string('building_type')->nullable();
            $table->double('latitude', 9, 6)->default(0);
            $table->double('longitude', 9, 6)->default(0);

            $table->integer('completion_year')->nullable();
            $table->integer('number_floor')->nullable();
            $table->integer('number_unit')->nullable();

            $table->string('developer_name')->nullable();
            $table->text('facilities')->nullable();
            $table->string('unit_size')->nullable();

            $table->string('condo_url')->nullable();
            $table->string('developer_url')->nullable();

            $table->string('image_url')->nullable();
            $table->string('descriptions')->nullable();

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('phrealestates', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phrealestates');
    }
}