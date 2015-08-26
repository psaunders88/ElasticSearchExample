<?php

require_once 'config.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Elasticsearch\Client;
use FakerSearch\ElasticSearch\ProductSearch;
use Symfony\Component\EventDispatcher\EventDispatcher;
use FakerSearch\Event\ProductUpdatedEvent;
use FakerSearch\Listener\ProductSearchListener;

/**
 * Services array
 */
$services = [];

/**
 * Setup EntityManager
 */
$paths = array("src/");
$isDevMode = false;

// the connection configuration
$dbParams = [
    'driver' => DB_DRIVER,
    'user' => DB_USER,
    'password' => DB_PASSWORD,
    'dbname' => DB_DBNAME,
];

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$services['em'] = EntityManager::create($dbParams, $config);

/**
 * Event Dispatcher
 */
$services['ed'] = new EventDispatcher();

/**
 * ElasticSearcg cliient
 */
$services['search_client'] = new Client();

/**
 * Product Search class
 */
$services['product_search'] = new ProductSearch($services['search_client']);

/**
 * Add listener to ED
 */
$services['ed']->addListener(
    ProductUpdatedEvent::PRODUCT_UPDATED,
    [new ProductSearchListener($services['product_search']), 'onProductUpdated']
);