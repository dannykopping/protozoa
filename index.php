<?php
    require "vendor/autoload.php";
    require_once "Protozoa/Protozoa.php";

    use Protozoa\Protozoa;
    use Protozoa\Schema\Schema;
    use Doctrine\DBAL\DriverManager;
    use Doctrine\DBAL\Configuration;

    $config           = new Configuration();
    $connectionParams = array(
        'dbname'   => 'triptrackr',
        'user'     => 'root',
        'password' => 'mac150189',
        'host'     => 'localhost',
        'driver'   => 'pdo_mysql',
    );

    $p = new Protozoa();
    $s = new Schema($config, $connectionParams);
    $s->analyze();

    print_r($s->getTables());
