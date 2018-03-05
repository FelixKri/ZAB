<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Rechnung;

class CreateRechnungsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rechnungs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reason');
            $table->integer('abrechner_id');
            $table->timestamps();
        });

        $this->create_test_rechnung();
    }

    public function create_test_rechnung()
    {
        Rechnung::create([
            'reason' => 'Test Rechnungskopf 1', 
            'abrechner_id' => 1
        ]);
        Rechnung::create([
            'reason' => 'Test Rechnungskopf 2', 
            'abrechner_id' => 1
        ]);
        Rechnung::create([
            'reason' => 'Test Rechnungskopf 3', 
            'abrechner_id' => 2
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rechnungs');
    }
}
