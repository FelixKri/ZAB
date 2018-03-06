<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Rechnungspos;

class CreateRechnungsposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rechnungspos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bezeichnung');
            $table->integer('gesamtbetrag');
            $table->boolean('bezahlt');
            $table->integer('rechnungs_id');
            $table->timestamps();
        });

        $this->create_test_rechnungspos();
    }

    public function create_test_rechnungspos()
    {
        Rechnungspos::create([
            'bezeichnung' => 'Test Rechnungspos 1', 
            'gesamtbetrag' => 500, 
            'bezahlt' => false,
            'rechnungs_id' => 1
        ]);
        Rechnungspos::create([
            'bezeichnung' => 'Test Rechnungspos 2', 
            'gesamtbetrag' => 300, 
            'bezahlt' => false,
            'rechnungs_id' => 2
        ]);
        Rechnungspos::create([
            'bezeichnung' => 'Test Rechnungspos 3 bezahlt', 
            'gesamtbetrag' => 800, 
            'bezahlt' => true,
            'rechnungs_id' => 3
        ]);
        Rechnungspos::create([
            'bezeichnung' => 'Test Rechnungspos 3 bezahlt nur von Felix', 
            'gesamtbetrag' => 200, 
            'bezahlt' => false,
            'rechnungs_id' => 3
        ]);
        Rechnungspos::create([
            'bezeichnung' => 'Test Rechnungspos 3 bezahlt aber nicht von Felix -> Testweise..', 
            'gesamtbetrag' => 200, 
            'bezahlt' => true,
            'rechnungs_id' => 3
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rechnungspos');
    }
}
