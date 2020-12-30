<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class PropertySearch{

    /** 
     * @var int|null
     */
    private $maxPrice;

    /**
     * @var int|null
     * @Assert\Range(min=10, max=500)
    */
    private $minSurface;

    /** 
     * @var ArrayCollection
     */
    private $options;


    public function __construct(){
        $this->options = new ArrayCollection();
    }

    /** 
     * @return PropertySearch
     */
    public function setMaxPrice(int $Maxprice){
        $this->maxPrice = $Maxprice;
        return $this;
    }

    /** 
     * @return int|null
     */
    public function getMaxPrice(){
        return $this->maxPrice;
    }

    /** 
     * @return PropertySearch
     */
    public function setMinSurface(int $MinSurface){
        $this->minSurface = $MinSurface;
        return $this;
    }

    /** 
     * @return int|null
     */
    public function getMinSurface(){
        return $this->minSurface;
    }

     /** 
     * @return ArrayCollection
     */
    public function setOptions($options): void
    {
        $this->options = $options;
    }

    /** 
     * @return ArrayCollection
     */
    public function getOptions(): ArrayCollection
    {
        return $this->options;
    }

}