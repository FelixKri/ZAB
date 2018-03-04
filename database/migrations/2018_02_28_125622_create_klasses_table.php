<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Klasse;
class CreateKlassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('klasses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        $this->create_test_klassen();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('klasses');
    }

    public function create_test_klassen(){
        Klasse::create([
            'name' => "3BHWII",
        ]);
        Klasse::create([
            'name' => "4BHWII",
        ]);
        Klasse::create([
            'name' => "2AHWIM",
        ]);
        Klasse::create([
            'name' => "4YHWIM",
        ]);
    }
}
