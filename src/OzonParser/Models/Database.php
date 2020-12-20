<?php 

namespace OzonParser\Models; 

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;

class Database {

    function __construct() {

        $capsule = new Capsule;

        $capsule->addConnection([
            "driver" => "mysql",
            "host" =>"192.168.10.10",
            "database" => "state4market",
            "username" => "homestead",
            "password" => "secret",
            'charset'   => 'utf8',
            'collation' => 'utf8_general_ci',
          ]);

        $capsule->setAsGlobal();

        $capsule->bootEloquent();
        

    }
}
