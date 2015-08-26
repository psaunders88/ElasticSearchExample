<?php

namespace FakerSearch\ElasticSearch;

use Elasticsearch\Client;
use FakerSearch\Model\Product;

class ProductSearch
{
    const INDEX = 'product';
    const TYPE = 'search';
    
    /**
     * Http client
     * 
     * @var Client
     */
    protected $client;
    
    /**
     * Class constructor
     * 
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    
    /**
     * Searches for records in elasticsearch
     * 
     * @param string $search
     * 
     * @return array
     */
    public function search($search)
    {
        return $this->client->search(
            [
                'index' => self::INDEX,
                'type' => self::TYPE,
                'body' => ['query' => ['match' => ['name' => $search]]]
            ]
        );
    }
    
    /**
     * Maintain the search service info by passing the product to it
     * 
     * @param Product $product
     */
    public function maintainSearch(Product $product)
    {
        return $this->client->index(
            [
                'body' => $product->toArray(),
                'index' => self::INDEX,
                'type' => self::TYPE,
                'id' => $product->getId()
            ]
        );
    }
}
