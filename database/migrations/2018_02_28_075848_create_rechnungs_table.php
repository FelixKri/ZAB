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
            $table->integer('reason_id');
            $table->integer('abrechner_id');
            $table->boolean('bezahlt')->default($value = false);
            $table->timestamps();
        });

        $this->create_test_rechnung();
    }

    public function create_test_rechnung()
    {
        Rechnung::create([
            'reason_id' => 1,
            'abrechner_id' => 1
        ]);
        Rechnung::create([
            'reason_id' => 2,
            'abrechner_id' => 1
        ]);
        Rechnung::create([
            'reason_id' => 3,
            'abrechner_id' => 1
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
