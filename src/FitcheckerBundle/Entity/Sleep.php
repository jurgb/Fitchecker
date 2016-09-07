<?php

namespace FitcheckerBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Sleep
 * @ORM\Entity(repositoryClass="FitcheckerBundle\Repository\SleepRepository")
 */
class Sleep
{
    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="sleeps")
     * @var ArrayCollection|User[]
     */
    private $users;

    /**
     * Sleep constructor.
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * @var int
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
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
