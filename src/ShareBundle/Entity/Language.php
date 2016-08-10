<?php

namespace ShareBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Language
 */
class Language
{
    public function __toString()
    {
        return $this->getLngDev();
    }
    
    // generate code
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
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $users;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add users
     *
     * @param \UserBundle\Entity\User $users
     * @return Language
     */
    public function addUser(\UserBundle\Entity\User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \UserBundle\Entity\User $users
     */
    public function removeUser(\UserBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
}
