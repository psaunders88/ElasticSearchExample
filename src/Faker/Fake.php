<?php

namespace FakerSearch\Faker;

use FakerSearch\Model\Product;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventDispatcher;
use FakerSearch\Event\ProductUpdatedEvent;
use Faker\Factory;
use Faker\Generator;

class Fake
{
    /**
     * Doctrine entity manager
     * 
     * @var EntityManager
     */
    protected $em;
    
    /**
     * Symfony Event Dispatcher
     * 
     * @var EventDispatcher
     */
    protected $ed;
    
    /**
     * Data Faker
     * 
     * @var Generator 
     */
    protected $faker;
    
    /**
     * Class constructor
     * 
     * @param EntityManager   $em
     * @param EventDispatcher $ed
     */
    public function __construct(
        EntityManager $em,
        EventDispatcher $ed
    ) {
        $this->em = $em;
        $this->ed = $ed;
        $this->faker = Factory::create(); 
    }
    
    /**
     * Fake a specific number of records
     * 
     * @param integer $count
     */
    public function fake($count = 1)
    {
        for ($i = 1; $i <= $count; $i++) {
            $product = $this->create();
            $this->em->persist($product);
            
            /**
             * I ought to flush this after multiple persists.
             * I'm doing this here because I want the id to be set on the 
             * product in the event
             */
            $this->em->flush();
            $this->ed->dispatch(
                ProductUpdatedEvent::PRODUCT_UPDATED,
                new ProductUpdatedEvent($product)
            );
        }
    }
    
    /**
     * Create a new (fake) product
     * 
     * @return Product
     */
    protected function create()
    {
        return new Product(
            $this->faker->sentence(3),
            $this->faker->imageUrl(),
            $this->faker->paragraph(3)
        );
    }
}
