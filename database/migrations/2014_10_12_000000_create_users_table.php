<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vorName');
            $table->string('nachName');
            $table->boolean('isAdmin');
            $table->boolean('canWrite');
            $table->integer('klasse_id')->nullable($value = true);
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        $this->create_test_users();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }

    public function create_test_users(){

        //erstellen der vorgefertigten user
        User::create([
            'vorName' => 'Felix',
            'nachName' => 'Kristandl',
            'isAdmin' => true,
            'canWrite' => true,
            'klasse_id' => 1,
            'email' => "felix.kristandl.student@htl-hallein.at",
            'password' => bcrypt("123"),
        ]);
        User::create([
            'vorName' => 'Philipp',
            'nachName' => 'Rettenbacher',
            'isAdmin' => true,
            'canWrite' => true,
            'klasse_id' => 1,
            'email' => "flips.rettei.student@htl-hallein.at",
            'password' => bcrypt("123"),
        ]);
        User::create([
            'vorName' => 'Timon',
            'nachName' => 'Grießfelder',
            'isAdmin' => true,
            'canWrite' => true,
            'klasse_id' => 2,
            'email' => "timon.grießfelder.student@htl-hallein.at",
            'password' => bcrypt("123"),
        ]);
        User::create([
            'vorName' => 'Florian',
            'nachName' => 'Rettenbacher',
            'isAdmin' => true,
            'canWrite' => true,
            'klasse_id' => 1,
            'email' => "rett.flo.student@htl-hallein.at",
            'password' => bcrypt("123"),
        ]);
        User::create([
            'vorName' => 'Angelo',
            'nachName' => 'Stankovic',
            'isAdmin' => true,
            'canWrite' => true,
            'klasse_id' => 1,
            'email' => "b.kristandl.student@htl-hallein.at",
            'password' => bcrypt("123"),
        ]);
        User::create([
            'vorName' => 'Johannes',
            'nachName' => 'Rehrl',
            'isAdmin' => true,
            'canWrite' => true,
            'klasse_id' => 3,
            'email' => "hons.rehrl.student@htl-hallein.at",
            'password' => bcrypt("123"),
        ]);
        User::create([
            'vorName' => 'Franz',
            'nachName' => 'Saler',
            'isAdmin' => true,
            'canWrite' => true,
            'klasse_id' => 2,
            'email' => "franz.saler.student@htl-hallein.at",
            'password' => bcrypt("123"),
        ]);


        //erstellen von zufallsusern
        for($i = 0; $i<=10; $i++){
            User::create([
                'vorName' => $this->generateRandomString(),
                'nachName' => $this->generateRandomString(),
                'isAdmin' => false,
                'canWrite' => false,
                'klasse_id' => rand(1, 4),
                'email' => $this->generateRandomString(20),
                'password' => bcrypt("123"),
            ]);
        }


    }
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
