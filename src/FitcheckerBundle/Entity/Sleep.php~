<?php

namespace FitcheckerBundle\Entity;

/**
 * Sleep
 */
class Sleep
{
    /**
     * @ManyToMany(targetEntity="User", mappedBy="sleeps")
     */
    private $users;

    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $hours;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set hours
     *
     * @param integer $hours
     *
     * @return Sleep
     */
    public function setHours($hours)
    {
        $this->hours = $hours;

        return $this;
    }

    /**
     * Get hours
     *
     * @return int
     */
    public function getHours()
    {
        return $this->hours;
    }
}
