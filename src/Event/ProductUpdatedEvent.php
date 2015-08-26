<?php

namespace FakerSearch\Event;

use Symfony\Component\EventDispatcher\Event;
use FakerSearch\Model\Product;

class ProductUpdatedEvent extends Event
{
    /**
     * The event name
     */
    const PRODUCT_UPDATED = 'product_updated';
    
    /**
     * Product
     * 
     * @var Product
     */
    protected $product;
    
    /**
     * Class constructor
     * 
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    
    /**
     * Returns the updated product
     * 
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }
}
