<?php

namespace FakerSearch\Model;

/**
 * @Entity
 * @Table(name="products")
 */
class Product
{
    /**
     * The id
     * 
     * @var integer
     * 
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;
    
    /**
     * The product name
     * 
     * @var string
     * 
     * @Column(length=140)
     */
    protected $name;
    
    /**
     * The path to the product image
     * 
     * @var string
     * 
     * @Column(length=140)
     */
    protected $image;
    
    /**
     * The full human reable description
     * 
     * @var string
     * 
     * @Column(length=140)
     */
    protected $description;
    
    /**
     * Class constrcutor
     * 
     * @param string $name
     * @param string $image
     * @param string $description
     */
    public function __construct($name, $image, $description)
    {
        $this->name = $name;
        $this->image = $image;
        $this->description = $description;
    }
    
    /**
     * Returns the id
     * 
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the name property
     * 
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the path to the image
     * 
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Returns the description
     * 
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    /**
     * Flatten this object into an array
     * 
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'description' => $this->description
        ];
    }
}
