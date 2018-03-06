<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\user_has_rechnungspos;

class CreateUserHasRechnungsposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_has_rechnungspos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('rechnungspos_id');
            $table->boolean('bezahlt');
            $table->integer('betrag');
            $table->timestamps();
        });

        $this->create_test_user_has_rechnungspos();
    }

    public function create_test_user_has_rechnungspos()
    {
        user_has_rechnungspos::create([
            //'vorName' => 'Felix',
            'user_id' => 1, 
            'rechnungspos_id' => 1, 
            'bezahlt' => false, 
            'betrag' => 100
        ]);
        user_has_rechnungspos::create([
            //'vorName' => 'Felix',
            'user_id' => 1, 
            'rechnungspos_id' => 2, 
            'bezahlt' => false, 
            'betrag' => 100
        ]);
        user_has_rechnungspos::create([
            //'vorName' => 'Felix',
            'user_id' => 1, 
            'rechnungspos_id' => 3, 
            'bezahlt' => true, 
            'betrag' => 800
        ]);
        user_has_rechnungspos::create([
            //'vorName' => 'Felix',
            'user_id' => 1, 
            'rechnungspos_id' => 4, 
            'bezahlt' => true, 
            'betrag' => 100
        ]);
        user_has_rechnungspos::create([
            //'vorName' => 'Felix',
            'user_id' => 1, 
            'rechnungspos_id' => 5, 
            'bezahlt' => false, 
            'betrag' => 300
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_has_rechnungspos');
    }
}
