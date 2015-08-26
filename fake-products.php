<?php
require_once '../vendor/autoload.php';
require_once 'app/bootstrap.php';

use FakerSearch\Faker\Fake;

$faker = new Fake($services['em'], $services['ed']);
$faker->fake(200);

echo 'done..'.PHP_EOL;