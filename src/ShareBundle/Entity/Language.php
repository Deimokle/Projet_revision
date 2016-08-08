<?php

namespace ShareBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Language
 */
class Language
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $lngDev;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set lngDev
     *
     * @param string $lngDev
     * @return Language
     */
    public function setLngDev($lngDev)
    {
        $this->lngDev = $lngDev;

        return $this;
    }

    /**
     * Get lngDev
     *
     * @return string 
     */
    public function getLngDev()
    {
        return $this->lngDev;
    }
}
