<?php
require_once 'vendor/autoload.php';
/**
 * Note: This file isn't ran by the CLI directly
 *       it needs to be placed in same dir as the vendors folder
 *       the actual bin is locaed here /vendor/bin/doctrine
 */
require_once 'app/bootstrap.php';

use Doctrine\ORM\Tools\Console\ConsoleRunner;

return ConsoleRunner::createHelperSet($services['em']);