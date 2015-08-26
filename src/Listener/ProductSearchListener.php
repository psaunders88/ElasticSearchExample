<?php

namespace FakerSearch\Listener;

use FakerSearch\ElasticSearch\ProductSearch;
use FakerSearch\Event\ProductUpdatedEvent;

class ProductSearchListener
{
    /**
     * Product search class
     * 
     * @var ProductSearch
     */
    protected $productSearch;
    
    /**
     * Class constructor
     * 
     * @param ProductSearch $productSearch
     */
    public function __construct(ProductSearch $productSearch)
    {
        $this->productSearch = $productSearch;
    }

    /**
     * The functon that should be called after a product is updated
     * 
     * @param ProductUpdatedEvent $event
     */
    public function onProductUpdated(ProductUpdatedEvent $event)
    {
        $this->productSearch->maintainSearch($event->getProduct());
    }
}
