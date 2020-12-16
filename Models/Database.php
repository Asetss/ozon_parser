<?php 

namespace Models; 

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;


class Database {

    function __construct() {

        $capsule = new Capsule;

        $capsule->addConnection([
            "driver" => "mysql",
            "host" =>"192.168.10.10",
            "database" => "state4market",
            "username" => "homestead",
            "password" => "secret"
          ]);
        // Make this Capsule instance available globally via static methods... (optional)
        $capsule->setAsGlobal();

        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $capsule->bootEloquent();
        

    }




}