<?php
    require "vendor/autoload.php";
    require_once "Protozoa/Protozoa.php";

    use Doctrine\DBAL\DriverManager;
    use Protozoa\Protozoa;
    use Doctrine\DBAL\Configuration;
    use Protozoa\Schema\Schema;

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
